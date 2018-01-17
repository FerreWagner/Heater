function switchStyle(title) {

    var link_list = document.getElementsByTagName('link');

    for (var i = 0, l = link_list.length; i < l; i++) {

        var rel = link_list[i].getAttribute('rel'),
            tmp_title = link_list[i].getAttribute('title');

        if (rel.indexOf('style') != - 1 && tmp_title)
            link_list[i].disabled = tmp_title != title;
    }

}

$('.styleswitcher-button').click(function() {

    var $styleswitcher = $('#styleswitcher');

    if ($styleswitcher.hasClass('styleswitcher-showed')) {
        $styleswitcher.removeClass('styleswitcher-showed');
    } else {
        $styleswitcher.addClass('styleswitcher-showed');
    }

});

$('#styleswitcher-navbar-style').on('change', function() {

    var $this = $(this),
        val = $this.val(),
        $navigation = $('#navigation');

    switch (val) {
        case 'style-1':
            $navigation.removeClass('navbar-fill').removeClass('navbar-underline');
            break;
        case 'style-2':
            $navigation.addClass('navbar-fill').removeClass('navbar-underline');
            break;
        case 'style-3':
            $navigation.removeClass('navbar-fill').addClass('navbar-underline');
            break;
    }

});