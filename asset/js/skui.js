if (window.jQuery) {
    $ = window.$ || window.jQuery;

    Object.defineProperty(String.prototype, "jq", {
        get: function () {
            return $("" + this)
        }
    });
    Object.defineProperty(Element.prototype, "jq", {
        get: function () {
            return $(this)
        }
    });

    $.fn.extend({
        loader: function (show) {
            if (show === false) {
                this.mask(false);
            } else {
                var l = this.mask().addClass("loader");
                if (this.is("body")) {
                    l.css({position: "fixed"})
                }
            }
            return this;
        },
        mask: function (show) {
            if (show === false) {
                this.find(".overlay").remove();
            } else {
                this.append('<div class="overlay">\
                                <div class="m-loader mr-20">\
                                  <svg class="m-circular" viewBox="25 25 50 50">\
                                  \t<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>\
                                  </svg>\
                                </div>\
                                <h3 class="l-text">Loading</h3>\
                          </div>');
            }
            return this.find(".overlay");
        },
        serializeObject: function () {
            var o = {};
            var a = (this.is("form") ? this : this.find(":input")).serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!$.isArray(o[this.name])) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        },
        updateUi: function () {
            updateUi.call(this);
            $(document).triggerHandler("update-ui-done", [this])
        }
    });

    var skui = {
        dataTable: function (container, data, config) {
            var _self = this;
            if (!container.is(".skui-data-table")) {
                return;
            }

            var filterForm = container.find(".filter-form");
            data = container.cacheData = $.extend({
                offset: 0,
                max: app.maxResult,
                searchText: ""
            }, data, filterForm.serializeObject());

            config = $.extend({
                url: "#",
                beforeLoad: function () {},
                afterLoad: function () {}
            }, container.data(), config);
            container.on("click", ".table-reload", function () {
                container.reload();
            });
            container.on("click", ".filter-form button", function () {
                if (this.jq.is(".clear-button")) {
                    filterForm[0].reset();
                }
                container.reload(filterForm.serializeObject());
            });
            container.on("keypress", ".filter-form input", function (e) {
                if (e.which == 13) {
                    container.reload(filterForm.serializeObject());
                }
            });

            function createEditItem(data) {
                data = $.extend({}, data)
                var url = data.url;
                delete data.url;
                var _popup = skui.editPopup(app.baseUrl + url, data, {
					size: "modal-lg",
                    title: "Create/Edit " + (config.feature ? config.feature : ''),
                    loaded: function (popup, body) {
                        container.trigger("popupLoaded", arguments);
                    },
                    preSubmit: function () {
                        if (container.trigger("popupPreSubmit", arguments) == false) {
                            return false
                        }
                    },
                    success: function () {
                        container.reload();
                        container.trigger("popupSubmit", arguments);
                    }
                })
            }

            container.on("click", ".add-new", function () {
                createEditItem($(this).data());
            });
            container.on("click", ".action-navigator [data-action]", function () {
                var $this = this.jq
                var data = $.extend({}, ($this.parent().data() || {}), $this.data())
                var action = data.action
                delete data.action
                container.trigger("onActionClick", [action, data]);
                container.trigger("onAction:" + action, [data]);
            });
            container.on("onActionClick", function (evt, action, data) {
                switch (action) {
                    case 'edit':
                        createEditItem(data);
                        break;
                    case "delete":
                    case "remove":
                        var url = data.url
                        delete data.url
						var ask = "Are you confirm to remove ?";
                        if(data.name) {
							ask = 'Are you confirm to remove "<b>' + data.name + '</b>" ?';
						}
                        skui.confirm(ask, function () {
                            container.loader();
                            skui.ajax({
                                url: app.baseUrl + url,
                                dataType: "json",
                                data: data,
                                response: function () {
                                    container.loader(false);
                                },
                                success: function (resp) {
                                    if (resp && resp.message) {
                                        if (resp.status == "success") {
                                            container.reload();
                                        }
                                        skui.notify(resp.message, resp.status);
                                    }
                                }
                            })
                        });
                        break;
                }
            });

            container.reload = function (reloadData) {
                if (config.beforeLoad.apply(this, [data]) == false) {
                    return;
                }
                var reqData = $.extend(data, reloadData);
                container.loader();
                skui.ajax({
                    method: "post",
                    url: app.baseUrl + config.url,
                    data: reqData,
                    dataType: "html",
                    response: function (resp) {
                        container.loader(false);
                    },
                    success: function (resp) {
                        resp = resp.jq;
                        if (resp.length) {
                            $.extend(container.cacheData, reloadData);
                            var tableBody = container.find(".skui-table");
                            tableBody.html(resp.find(".skui-table").html());
                            tableBody.updateUi();
                            container.find(".filter-form").prev("input").val(reqData.searchText);
                            container.find(".pagination").replaceWith(resp.find(".pagination"));
                            _self.pagination(container);
                            config.afterLoad.apply(this, arguments);
                        }
                    }
                });
            };
            _self.pagination(container);

            return container;
        },
		paginatedPage: function(container, data, config) {
			var _self = this;
			if (!container.is(".skui-paginated-page")) {
				return;
			}

			var filterForm = container.find(".filter-form");
			data = container.cacheData = $.extend({
				page: 0,
				max: app.maxResult,
				searchText: ""
			}, data, filterForm.serializeObject());

			config = $.extend({
				url: "#"
			}, container.data(), config);
			container.on("click", ".filter-form button", function () {
				if (this.jq.is(".clear-button")) {
					filterForm[0].reset();
				}
				container.reload(filterForm.serializeObject());
			});
			container.on("keypress", ".filter-form input", function (e) {
				if (e.which == 13) {
					container.reload(filterForm.serializeObject());
				}
			});

			_self.pagination(container);

			container.reload = function (reloadData) {
				var reqData = $.extend(data, reloadData);
				container.loader();
				$.extend(container.cacheData, reloadData);
				location.href = app.baseUrl + config.url + "?page=" + data.page;
			};
		},
        pagination: function (container) {
            var pagination = container.find(".pagination");
            
            const count = parseInt(pagination.data("count"));
            const offset = parseInt(pagination.data("offset"));
            var data = $.extend({
                offset: offset ? offset : 0,
				page: 0,
                max: app.maxResult
            }, container.cacheData);
            if (!count) {
                return
            }
            if (data.max == count) {
                data.offset = 0
            }
            return pagination.twbsPagination({
                startPage: (data.offset / data.max) + 1,
                visiblePages: 3,
                first: "«",
                prev: "‹",
                next: "›",
                last: "»",
                initiateStartPageClick: false,
                totalPages: Math.ceil(count / data.max),
                onPageClick: function (evt, _offset) {
					data.page = _offset - 1;
					data.offset = (_offset - 1) * data.max;
                    container.reload(data);
                }
            });
        },
        ajax: function (settings) {
            if (!settings) {
                return;
            }
            var response = settings.response
                    , success = settings.success
                    , error = settings.error;
            delete settings.response;
            delete settings.success;
            delete settings.error;
            $.extend(settings.data, {
                ajax: true
            })
            var _settings = $.extend({
                dataType: "json",
                success: function (resp) {
                    response && response.call(this);
                    if (skui.silentLogin(resp)) {
                        success && success.apply(this, arguments);
                    }
                },
                error: function (errorObj) {
                    response && response.call(this);
                    if (skui.silentLogin(errorObj.responseText)) {
                        error && error.apply(this, arguments);
                    }
                }
            }, settings);
            return $.ajax(_settings);
        },
        ajaxForm: function (form, settings) {
            if (!form.length || !settings) {
                return;
            }
            var response = settings.response;
            var beforeSubmit = settings.beforeSubmit;
            var success = settings.success;
            var error = settings.error;
            delete settings.response;
            delete settings.beforeSubmit;
            delete settings.success;
            delete settings.error;
            var _settings = $.extend({
                type: "POST",
                dataType: "json",
                beforeSubmit: function (arr, $form, options) {
                    arr.push({
                        name: "ajax",
                        value: true
                    })
                    if (form.triggerHandler("beforeSubmit") == false) {
                        return false;
                    }
                    if (beforeSubmit && beforeSubmit.apply(this, arguments) == false) {
                        return false
                    }
                },
                success: function (resp, type) {
                    response && response.call(this);
                    if (skui.silentLogin(resp)) {
                        success && success.apply(this, arguments);
                    }
                },
                error: function (errorObj) {
                    response && response.call(this);
                    if (skui.silentLogin(errorObj.responseText)) {
                        error && error.apply(this, arguments);
                    }
                }
            }, settings);

            return form.ajaxForm(_settings);
        },
        notify: function (message, type) {
            type = type || "info"
            type = type == "error" ? "danger" : type;
            var alert = $('<div class="skui-alert alert alert-'+type+' alert-dismissible fade show" role="alert">\
			  <strong style="text-transform:capitalize;">' + type + '! </strong>' + message + '.\
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>\
			</div>');
            $("body").prepend(alert);
            setTimeout(function () {
				alert.alert('close');
			}, 8000);
            return alert.alert();
        },
        editPopup: function (url, data, config) {
            var content = ""
            config = $.extend({
                class: "",
                title: "",
                width: 600,
                size: "modal-lg",
                preSubmit: undefined,
                loaded: undefined
            }, config);
            config.size = config.size == "sm" ? "modal-sm" : (config.size == "md" ? "modal-md" : config.size)
            data = $.extend({
                id: undefined
            }, data);
            if (typeof url != "string") {
                content = url;
            }
            var popup = $('<div class="modal fade skui-popup skui-edit-popup ' + config.class + '" tabindex="-1" role="document" aria-hidden="true">\
            <div class="modal-dialog ' + config.size + '" role="document">\
            	<div class="modal-content">\
                   <div class="modal-header">\
                   		<h5 class="modal-title popup-title">' + config.title + '</h5>\
                        <span class="close fas fa-window-close" data-dismiss="modal"></button>\
                    </div>\
                    <div class="modal-body popup-body"></div>\
                    <div class="modal-footer popup-footer">\
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>\
                    </div>\
                    </div>\
                </div>\
            </div>');

            $("body").append(popup);

            popup.on("show.bs.modal", function () {
                var body = popup.find(".popup-body");
                if (content && content.length) {
                    popupLoaded(content);
                } else {
                    body.loader();
                    skui.ajax({
                        url: url,
                        data: data,
                        dataType: "html",
                        response: function () {
                            body.loader(false);
                        },
                        success: function (resp) {
                            popupLoaded(resp.jq);
                        }
                    });
                }

                function popupLoaded(content) {
                    var title = content.find(".form-title");
                    if (title.length) {
                        popup.find(".popup-title").html(title);
                    } else {
                        popup.find(".popup-title").html(config.title);
                    }
                    var form = content.filter("form");
                    if (!form.length) {
                        form = content.find("form:first");
                    }
                    form.attr("id", "create-edit-form-submit");
                    popup.find(".popup-footer").prepend(content.find(".form-submit").attr("form", "create-edit-form-submit"));
                    body.html(content);
                    content.updateUi();
                    popup.modal('handleUpdate');

                    skui.ajaxForm(form, {
                        type: "POST",
                        dataType: "json",
                        beforeSubmit: function (arr, $form, options) {
                            form.loader();
                            if (config.preSubmit) {
                                return config.preSubmit.apply(this, arguments);
                            }
                        },
                        success: function (resp, type) {
                            if (resp && resp.message) {
                                skui.notify(resp.message, resp.status);
                            }
                            if (config.success) {
                                config.success.apply(this, arguments);
                            }
                            popup.modal("hide");
                        },
                        response: function () {
                            form.loader(false);
                            if (config.response) {
                                config.response.apply(this);
                            }
                        }
                    });
                    config.loaded && config.loaded.apply(popup, body);
                }
            });
            popup.on("hidden.bs.modal", function () {
                var _popup = this.jq;
                config.close && config.close.apply(this, arguments);
                _popup.removeData();
                _popup.modal('dispose');
                _popup.remove();

            });
            popup.modal({
                backdrop: true,
                keyboard: true,
                show: true
            });
            return popup;
        },
        confirm: function (message, yes, no) {
            var popup = $('<div class="skui-popup skui-confirm modal fade" tabindex="-1" role="document" aria-hidden="true">\
            <div class="modal-dialog modal-md" role="document">\
            	<div class="modal-content">\
                   <div class="modal-header">\
                        <h5 class="modal-title popup-title">Confirm!</h5>\
                        <span class="close fas fa-window-close" data-dismiss="modal"></button>\
                    </div>\
                    <div class="modal-body"><p>' + message + '</p></div>\
                    <div class="modal-footer">\
                    	<button type="button" class="btn btn-primary yes" data-dismiss="modal">Yes</button>\
                        <button type="button" class="btn btn-warning no" data-dismiss="modal">No</button>\
                    </div>\
                    </div>\
                </div>\
            </div>');

            popup.on("click", ".modal-footer", function (evt) {
				if ($(evt.target).is(".yes")) {
					yes && yes();
				} else {
					no && no();
				}
				popup.modal('hide');
			})

            popup.on("hidden.bs.modal", function (evt) {
                popup.removeData();
                popup.modal('dispose');
                popup.remove();
            });

            popup.modal({
                backdrop: true,
                keyboard: false,
                focus: true,
                show: true
            });
            return popup;
        },
        imageInput: function (inputControl) {
            var fileInput = inputControl.find("input[type=file]")
            var imgPrev = inputControl.find(".skui-image-preview")

            fileInput.on("change", function (evt) {
                var files = evt.target.files
                if (!files.length) {
                    return
                }
                var reader = new FileReader()
                reader.onload = function (frEvent) {
                    imgPrev.attr("src", frEvent.target.result)
                }
                reader.readAsDataURL(files[0])
            })
        },
		accordion: function(panel) {
			if (!panel.is(".skui-accordion-panel")) {
				return
			}
			panel.expand = function(label) {
				panel.find(".skui-accordion-label").removeClass("expanded");
				panel.find(".skui-accordion-item").removeClass("expanded").hide();
				label.addClass("expanded");
				label.next(".skui-accordion-item").addClass("expanded").show();
			}
			panel.expand(panel.find(".skui-accordion-label:first"));
			panel.on("click", ".skui-accordion-label", function(evt) {
				var label = this.jq;
				if(label.is(".expanded")) {
					label.removeClass("expanded");
					label.next(".skui-accordion-item").removeClass("expanded").hide();
				} else {
					panel.expand(this.jq);
				}
			})
			return panel;
		},
        toggle: function (container) {
            var inputs = container.find("[data-toggle-target]");
            if (!inputs.length) {
                return
            }

            inputs.each(function () {
                var input = this.jq;
                var target = input.attr("data-toggle-target");
                var selected = container.find("[class^='" + target + "-'], [class*=' " + target + "-']")
                if (!selected.hasClass(target + "-" + input.val())) {
                    selected.hide();
                }

                if (input.is("select")) {
                    input.change(function () {
                        container.find("[class^='" + target + "-'], [class*=' " + target + "-']").hide().find("input, select, textarea").attr("disabled", true);
                        container.find("." + target + "-" + input.val()).show().find("input, select, textarea").removeAttr("disabled");
                    }).trigger("change")
                }
            })
        },
        silentLogin: function () {
            try {
                resp = $(resp)
            } catch (ex) {
                resp = $()
            }
            if (resp.is(".silent-login-popup")) {
                skui.editPopup(resp)
                return false
            }
            return true
        }
    };


    function updateUi() {
        let delegate = this;
        delegate.find(".skui-data-table").each(function () {
            skui.dataTable($(this));
        });
		skui.paginatedPage(delegate.find(".skui-paginated-page"))
        this.find(".skui-file-chooser").on("change", "input[type=file]:last", function () {
            if (this.value) {
                if ((this.files[0].size / 1024) > (+this.jq.attr("max-size"))) {
                    skui.notify("Max size 2 MB");
                    this.jq.replaceWith(this.jq.val('').clone(true));
                    return false;
                }
                if (!this.jq.is(".single")) {
                    var input = $('<div class="input"><input type="file" name="s_image[]" value="" max-size="2048"><i class="action remove fa fa-times color-red" title="Remove"></i></div>');
                    this.jq.parents(".input").after(input);
                    input.find(".remove").click(function () {
                        this.jq.parents(".input").remove();
                    })
                }
            }
        });
        this.find(".skui-image-chooser").each(function () {
            skui.imageInput(this.jq);
        });
		this.find(".skui-accordion-panel").each(function() {
			skui.accordion(this.jq);
		})
        skui.toggle(this);
        var form = this.find(".ajax-submit");
        skui.ajaxForm(form, {
            type: "POST",
            dataType: "json",
            beforeSubmit: function (arr, $form, options) {
                form.loader();
            },
            response: function () {
                form.loader(false);
            },
            success: function (resp, type) {
                if (resp && resp.message) {
                    skui.notify(resp.message, resp.status);
                }
                if(resp.redirect) {
                	location.href = resp.redirect;
				}
            }
        });

		delegate.find('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
			var $el = $(this);
			var $parent = $(this).offsetParent(".dropdown-menu");
			if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
			}
			var $subMenu = $(this).next(".dropdown-menu");
			$subMenu.toggleClass('show');

			$(this).parent("li").toggleClass('show');

			$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
				$('.dropdown-menu .show').removeClass("show");
			});

			if (!$parent.parent().hasClass('navbar-nav')) {
				$el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
			}

			return false;
		});
    }

    $(function () {
        var body = $("body");
        app.maxResult = 10;
        body.updateUi();
    });


} else {
    console.log("jQuery missing!");
}
