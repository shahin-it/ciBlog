$(document).on("update-ui-done", function (evt, container) {

	var target = container.find(".skui-text-editor");
	if (target.length && window.tinymce) {
		target.parent().css({position: "relative"});
		tinymce.init({
			target: target[0],
			height: 200,
			setup: function(editor) {
				editor.on('change', function (e) {
					editor.save();
				});
			},
			theme: 'modern',
			plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
			toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
			image_advtab: true,
			templates: [
				{ title: 'Test template 1', content: 'Test 1' },
				{ title: 'Test template 2', content: 'Test 2' }
			],
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			]
		})
	}

}).on("focusin", function(e) {
	if ($(e.target).closest(".mce-window, .moxman-window").length) {
		e.stopImmediatePropagation();
	}
});
