if(window.jQuery) {
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
		loader: function(show) {
			if(show === false) {
				this.mask(false);
			} else {
				var l = this.mask().addClass("loader");
				if(this.is("body")) {
					l.css({position: "fixed"})
				}
			}
			return this;
		},
		mask: function(show) {
			if(show === false) {
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
		}
	});

	var skui = {
		dataTable: function (container, data, config) {
			var _self = this;
			if (!container.is(".skui-data-table")) {
				return;
			}

			var filterForm = container.find(".filter-form");
			data = container._data = $.extend({
				offset: 0,
				max: app.maxResult,
				searchText: ""
			}, data, filterForm.serializeObject());

			config = $.extend({
				url: "#",
				beforeLoad: function() {},
				afterLoad: function() {}
			}, container.data(), config);
			container.on("click", ".table-reload", function() {
				container.reload();
			});
			container.on("click", ".filter-form button", function() {
				if (this.jq.is(".clear-button")) {
					filterForm[0].reset();
				}
				container.reload(filterForm.serializeObject());
			});
			container.on("keypress", ".filter-form input", function(e) {
				if (e.which == 13) {
					container.reload(filterForm.serializeObject());
				}
			});

			function createEditItem(data) {
				data = $.extend({}, data)
				var url = data.url;
				delete data.url;
				var _popup = skui.editPopup(app.baseUrl + url, data, {
					title: "Create/Edit " + (config.feature ? config.feature:''),
					loaded: function (popup, body) {
						container.trigger("popupLoaded", arguments);
					},
					preSubmit: function() {
						if(container.trigger("popupPreSubmit", arguments) == false) {
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
			container.on("click", ".action-navigator [data-action]", function() {
				var $this = this.jq
				var data = $.extend({}, ($this.parent().data() || {}), $this.data())
				var action = data.action
				delete data.action
				container.trigger("onActionClick", [action, data]);
				container.trigger("onAction:" + action, [data]);
			});
			container.on("onActionClick", function(action, data) {
				switch (action) {
					case 'edit':
						createEditItem(data);
						break;
					case "delete":
					case "remove":
						var url = data.url
						delete data.url
						skui.confirm("Are you confirm to remove?", function() {
							container.loader();
							sui.ajax({
								url: url,
								dataType: "json",
								data: data,
								response: function() {
									container.loader(false);
								},
								success: function(resp) {
									if (resp && resp.message) {
										if(resp.status == "success") {
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

			container.reload = function(reloadData) {
				var before = config.beforeLoad.apply(this, [data]);
				if (before == false) {
					return;
				}
				var reqData = $.extend(data, reloadData);
				container.loader();
				sui.ajax({
					method: "post",
					url: config.url,
					data: reqData,
					dataType: "html",
					response: function(resp) {
						container.loader(false);
					},
					success: function(resp) {
						resp = resp.jq;
						if (resp.length) {
							$.extend(container._data, reloadData);
							var tableBody = container.find(".skui-table");
							tableBody.html(resp.find(".skui-table").html());
							tableBody.updateUi();
							container.find(".filter-form").prev("input").val(reqData.searchText);
							_self.pagination(container);
							config.afterLoad.apply(this, arguments);
						}
					}
				});
			};
			_self.pagination(container);

			return container;
		},
		pagination: function (container) {
			var pagination = container.find(".pagination");
			var count = parseInt(pagination.data("count"));
			var data = $.extend({
				offset: 0,
				max: app.maxResult
			}, container._data);
			if (!count) {
				return
			}
			if (data.max == count) {
				data.offset = 0
			}
			return pagination.twbsPagination({
				startPage: (data.offset / data.max) + 1,
				visiblePages: 3,
				first: '&laquo;&laquo;',
				prev: '&laquo;',
				next: '&raquo;',
				last: '&raquo;&raquo;',
				initiateStartPageClick: false,
				totalPages: Math.ceil(count / data.max),
				prev: "Prev",
				onPageClick: function(evt, offset) {
					data.offset = (offset - 1) * data.max;
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
			settings = $.extend({
				dataType: "json",
				success: function(resp) {
					response && response.call(this);
					if (skui.silentLogin(resp)) {
						success && success.apply(this, arguments);
					}
				},
				error: function(errorObj) {
					response && response.call(this);
					if (skui.silentLogin(errorObj.responseText)) {
						error && error.apply(this, arguments);
					}
				}
			}, settings);
			return $.ajax(settings);
		},
		ajaxForm: function(form, settings) {
			if (!settings) {
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
			settings = $.extend({
				type: "POST",
				dataType: "json",
				beforeSubmit: function(arr, $form, options) {
					arr.push({
						name: "ajax",
						value: true
					})
					if (form.triggerHandler("preSubmit") == false) {
						return false;
					}
					if (beforeSubmit) {
						beforeSubmit = beforeSubmit.apply(this, arguments);
						if (beforeSubmit == false) {
							return false
						}
					}
				},
				success: function(resp, type) {
					response && response.call(this);
					if (skui.silentLogin(resp)) {
						success && success.apply(this, arguments);
					}
				},
				error: function(errorObj) {
					response && response.call(this);
					if (skui.silentLogin(errorObj.responseText)) {
						error && error.apply(this, arguments);
					}
				}
			}, settings)

			return form.ajaxForm(settings);
		},
		notify: function(message, type) {
			type = type || "info"
			type = type == "error" ? "danger" : type;
			var alert = $('<div class="alert alert-warning alert-dismissible fade show" role="alert">\
			  <strong>'+type+'</strong> You should check in on some of those fields below.\
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>\
			</div>');
			return alert.alert();
		},
		editPopup: function(url, data, config) {
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
			var popup = $('<div class="modal fade skui-edit-popup ' + config.class + '" tabindex="-1" role="document" aria-hidden="true">\
            <div class="modal-dialog modal-content ' + config.size + '" role="document">\
                   <div class="modal-header">\
                   		<h5 class="modal-title popup-title">' + config.title + '</h5>\
                        <button type="button" class="close" data-dismiss="modal">&times;</button>\
                    </div>\
                    <div class="modal-body popup-body"></div>\
                    <div class="modal-footer popup-footer">\
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>\
                    </div>\
                </div>\
            </div>');

			$("body").append(popup);

			popup.on("show.bs.modal", function() {
				var body = popup.find(".popup-body");
				if (content && content.length) {
					popupLoaded(content);
				} else {
					body.loader();
					skui.ajax({
						url: url,
						data: data,
						dataType: "html",
						response: function() {
							body.loader(false);
						},
						success: function(resp) {
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
					var form =  content.filter("form");
					if(!form.length) {
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
						beforeSubmit: function(arr, $form, options) {
							form.loader();
							if (config.preSubmit) {
								return config.preSubmit.apply(this, arguments);
							}
						},
						success: function(resp, type) {
							if (resp && resp.message) {
								skui.notify(resp.message, resp.status);
							}
							if (config.success) {
								config.success.apply(this, arguments);
							}
							popup.modal("hide");
						},
						response: function() {
							form.loader(false);
							if (config.response) {
								config.response.apply(this);
							}
						}
					});
					config.loaded && config.loaded.apply(popup, body);
				}
			});
			popup.on("hidden.bs.modal", function() {
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
		confirm: function(message, yes, no) {
			var popup = $('<div class="modal fade" tabindex="-1" role="document" aria-hidden="true">\
            <div class="modal-dialog modal-content modal-sm" role="document">\
                   <div class="modal-header">\
                        <h5 class="modal-title popup-title">Confirm!</h5>\
                        <button type="button" class="close" data-dismiss="modal">&times;</button>\
                    </div>\
                    <div class="modal-body"><p>' + message + '</p></div>\
                    <div class="modal-footer">\
                    	<button type="button" class="btn btn-primary yes" data-dismiss="modal">Yes</button>\
                        <button type="button" class="btn btn-warning no" data-dismiss="modal">No</button>\
                    </div>\
                </div>\
            </div>');

			popup.on("hidden.bs.modal", function(evt) {
				var _popup = this.jq;
				if($(evt.target).is(".yes")) {
					yes && yes();
				} else {
					no && no();
				}
				_popup.removeData();
				_popup.modal('dispose');
				_popup.remove();

			});

			popup.modal({
				backdrop: true,
				keyboard: false,
				focus: true,
				show: true
			});
			return popup;
		},
		imageInput: function(inputControl) {
			var fileInput = inputControl.find("input[type=file]")
			var imgPrev = inputControl.find(".skui-image-preview")

			fileInput.on("change", function(evt) {
				var files = evt.target.files
				if (!files.length) {
					return
				}
				var reader = new FileReader()
				reader.onload = function(frEvent) {
					imgPrev.attr("src", frEvent.target.result)
				}
				reader.readAsDataURL(files[0])
			})
			var imgData = fileInput
		},
		toggle: function(container) {
			var inputs = container.find("[data-toggle-target]");
			if (!inputs.length) {
				return
			}

			inputs.each(function() {
				var input = this.jq;
				var target = input.attr("data-toggle-target");
				var selected = container.find("[class^='" + target + "-'], [class*=' " + target + "-']")
				if (!selected.hasClass(target + "-" + input.val())) {
					selected.hide();
				}

				if (input.is("select")) {
					input.change(function() {
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
				sui.editPopup(resp)
				return false
			}
			return true
		}
	};


	function updateUi() {
		var delegate = this;
		delegate.find(".skui-data-table").each(function () {
			skui.dataTable($(this));
		})
		this.find(".skui-file-chooser").on("change", "input[type=file]:last", function() {
			if(this.value) {
				if((this.files[0].size/1024) > (+this.jq.attr("max-size"))) {
					skui.notify("Max size 2 MB");
					this.jq.replaceWith(this.jq.val('').clone(true));
					return false;
				}
				if(!this.jq.is(".single")) {
					var input = $('<div class="input"><input type="file" name="s_image[]" value="" max-size="2048"><i class="action remove fa fa-times color-red" title="Remove"></i></div>');
					this.jq.parents(".input").after(input);
					input.find(".remove").click(function() {
						this.jq.parents(".input").remove();
					})
				}
			}
		});
		this.find(".skui-image-chooser").each(function () {
			skui.imageInput(this.jq);
		})
		skui.toggle(this);
		var form = this.find(".ajax-submit");
		skui.ajaxForm(form, {
			type: "POST",
			dataType: "json",
			beforeSubmit: function(arr, $form, options) {
				form.loader();
			},
			response: function() {
				form.loader(false);
			},
			success: function(resp, type) {
				if(resp && resp.message) {
					skui.notify(resp.message, resp.status);
				}
			}
		});
	}

	$(function() {
		var body = $("body");
		body.updateUi();
	});


} else {
	console.log("jQuery missing!");
}