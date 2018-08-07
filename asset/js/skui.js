if(!window.jQuery) {
    console.log("jQuery missing!");
}
var skui = {
    pagination: function (page) {
        return page.twbsPagination({
            totalPages: 35,
            visiblePages: 7,
            first: '&laquo;&laquo;',
            prev: '&laquo;',
            next: '&raquo;',
            last: '&raquo;&raquo;',
            onPageClick: function (event, page) {
                $('#page-content').text('Page ' + page);
            }
        });
    },
    dataTable: function (content) {
        var data = content.data();
        content.on("click", ".add-button", function () {
            
        });
        
        return content;
    },
    ajax: function (settings) {
        $.extend(settings, {
            
        });
        return $.ajax(settings);
    }
};

$.fn.extend({
    updateUi: function () {
        updateUi.call(this);
    }
});

function updateUi() {
    var delegate = this;
    delegate.find(".pagination").each(function () {
        skui.pagination($(this));
    });
//    delegate.find(".action-column button").tooltip()
    
}

$(function() {
    var body = $("body");
    body.updateUi();
});