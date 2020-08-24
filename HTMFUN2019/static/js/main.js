(function($) {
    "use strict";
    $('.nav-button').on('click', function() {
        $('body').toggleClass('nav-open');
    });
    $('.post-carousel').owlCarousel({
        dots: false,
        nav: false,
        margin: 30,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    new WOW().init();
    jQuery(document).ready(function($) {
        $('.post-social').theiaStickySidebar({
            additionalMarginTop: 33,
            additionalMarginBottom: 200,
            defaultPosition: 'absolute'
        });
        $('.article-index').theiaStickySidebar({
            containerSelector:'.col-lg-8.mx-auto.post-box',
            additionalMarginTop: 33,
            additionalMarginBottom: 200,
            defaultPosition: 'absolute'
        });
    });

    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
    })



    commentAjax()
    function commentAjax() {
        // 键盘监听
        $(document).keypress(function(e) {
            if (e.ctrlKey && e.which == 13 || e.which == 10) {
                $("#submit").click();
                document.body.focus();
            } else if (e.shiftKey && e.which == 13 || e.which == 10) {
                $("#submit").click();
            }
        })
        var $commentform = $('#commentform'),
            $comments = $('#comments-title'),
            $cancel = $('#cancel-comment-reply-link'),
            cancel_text = "取消回复";
        $('.comment-from-textarea').append('<div id="comment_message" style="display:none;"></div>');
        $('#commentform').on("submit", function(e) {
            $('#comment_message').slideDown().html("<p>评论提交中....</p>");
            $('#submit').addClass("disabled").val("发表评论").attr("disabled", "disabled");
            $.ajax({
                url: stayma_url.url_ajax,
                data: $(this).serialize() + "&action=ajax_comment",
                type: $(this).attr('method'),
                error: function(request) {
                    $('#comment_message').addClass('comt-error').html(request.responseText);
                    setTimeout("$('#submit').removeClass('disabled').val('发表评论').attr('disabled',false)", 2000);
                    setTimeout("$('#comment_message').slideUp()", 2000);
                    setTimeout("$('#comment_message').removeClass('comt-error')", 3000);
                },
                success: function(data) {
                    $('textarea').each(function() {
                        this.value = ''
                    });
                    var t = addComment,
                        cancel = t.I('cancel-comment-reply-link'),
                        temp = t.I('wp-temp-form-div'),
                        respond = t.I(t.respondId),
                        post = t.I('comment_post_ID').value,
                        parent = t.I('comment_parent').value;
                    if (parent != '0') {
                        $('#respond').before('<ul class="children">' + data + '</ul>');
                    } else if ($('.commentlist').length != '0') {
                        $('.commentlist').append(data);
                    } else {
                        $('.commentlist').append(data);
                    }
                    // $('#comment_message').html("<p>评论提交成功</p>");
                    site_tips(1, "评论成功")
                    setTimeout("$('#submit').removeClass('disabled').val('发表评论').attr('disabled',false)", 2000);
                    setTimeout("$('#comment_message').slideUp()", 1000);
                    cancel.style.display = 'none';
                    cancel.onclick = null;
                    t.I('comment_parent').value = '0';
                    if (temp && respond) {
                        temp.parentNode.insertBefore(respond, temp);
                        temp.parentNode.removeChild(temp)
                    }
                }
            });
            return false;
        });
    }

    function isNumber(value) {
        var patrn = /^(-)?\d+(\.\d+)?$/;
        if (patrn.exec(value) == null || value == "") {
            return false
        } else {
            return true
        }
    }
    // 评论快速获取QQ信息
    $("input#author").blur(function() {
        var _author = $(this).val();
        if (_author) {
            if (isNumber(_author)) {
                $.getJSON(stayma_url.url_ajax + '?action=ajax_qq_info&qqNum=' + _author, function(xhr) {
                    if (xhr[_author] == undefined) {
                        tips_update('你的QQ号不存在，请检查，如果不使用QQ号，建议使用中英文昵称。');
                        $("input#author").focus();
                    } else if (xhr[_author][6] == "") {
                        tips_update('你的QQ号可能是长期不登录或冻结状态？请检查。');
                        $("input#author").focus();
                    } else {
                        $("input#author").val(xhr[_author][6]);
                        $("input#email").val(_author + '@qq.com');
                        $("input#url").val('https://user.qzone.qq.com/' + _author);
                        $('#comment').focus();
                        //console.log(xhr);
                    }
                });
            }
        }
        return;
    });

    function commentListAjax() {
        $('#comments-navi a').on('click', function(e) {
            let href = this.href;
            $.ajax({
                url: href,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('.commentlist').hide(600)
                },
                error: function() {}
            })
            return false;
        })
    }
    // 点赞
    $.fn.postLike = function() {
        if ($(this).hasClass('done')) {
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
                action = $(this).data('action'),
                rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "bigfa_like",
                um_id: id,
                um_action: action
            };
            $.post("/wp-admin/admin-ajax.php", ajax_data, function(data) {
                $(rateHolder).html(data);
            });
            site_tips(1, "谢谢点赞")
            return false;
        }
    };
    $(document).on("click", ".favorite", function() {
        $(this).postLike();
    });
    $(document).on('click', '.single-weixin', function(event) {
        event.preventDefault();
        var img = $(this).data("img");
        $('body').append('<div class="nice-tips" id="post_qrcode">\
                        <div class="nice-tips-overlay"></div>\
                        <div class="nice-tips-content mini-tips-content text-center">\
                            <h6 class="py-1">微信扫一扫 分享朋友圈</h6>\
                            <p>在微信中请长按二维码</p>\
                            <img src="' + img + '" alt="微信扫一扫,分享到朋友圈">\
                            <div class="btn-close-tips">\
                                <i class="iconfont icon-guanbi1"></i>\
                            </div>\
                        </div>\
                    </div>');
        var selector = "#post_qrcode";
        var close_icon = $(selector).find('.btn-close-tips');
        $(selector).addClass('nice-tips-open').find('.btn-close-tips').on('click touchstart', function(event) {
            event.preventDefault();
            $(selector).removeClass('nice-tips-open');
            $(selector).addClass('nice-tips-close');
            $('body').removeClass('modal-open');
            setTimeout(function() {
                $(selector).removeClass('nice-tips-close');
                setTimeout("$('.nice-tips').remove()", 200);
            }, 600);
            close_icon.unbind();
        });
        $('body').addClass('modal-open');
        $('body').on("keyup", function(e) {
            if (e.keyCode === 27) close_icon.click();
        });
    });
    // top
    function scrollTop() {
        let scrTopBtn = $('#nice-back-to-top'),
            startPoint = $(window).height() / 2;
        scrTopBtn.on("click", function() {
            $("html, body").stop().animate({
                scrollTop: 0
            }, 600);
        });
        if ($(window).scrollTop() >= startPoint && $(window).width() >= 1024) {
            scrTopBtn.addClass('active');
        } else {
            scrTopBtn.removeClass('active');
        }

        if ($(window).scrollTop() >= 150 && $(window).width() >= 1024) {
            $('.article-index').addClass('active');
        } else {
            $('.article-index').removeClass('active');
        }


    }
    jQuery(document).scroll(function($) {
        scrollTop()
    });
    // 提示
    function site_tips(type, msg) {
        var ico = type ? '<span class="d-block h2 text-primary mb-2"><i class="iconfont icon-dui"></i></span>' : '<span class="d-block h2 text-dark mb-2"><i class="iconfont icon-cuowu"></i></span>';
        var c = type ? 'tips-success' : 'tips-error';
        var html = '<section class="nice-tips ' + c + ' nice-tips-open">' + '<div class="nice-tips-content  text-center">' + ico + '<p class="text-md">' + msg + '</p>' + '</div>' + '</section>';
        $('body').append(html);
        setTimeout(function() {
            $('.nice-tips').removeClass('nice-tips-open');
            $('.nice-tips').addClass('nice-tips-close');
            setTimeout(function() {
                $('.nice-tips').removeClass('nice-tips-close');
                setTimeout("$('.nice-tips').remove()", 200);
            }, 400);
        }, 1200);
    }


        // 滚动
        $('#article-index a[href*="#"]:not([href="#"])').click(function() {
            if ( location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname ) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
                if (target.length) {
                    $("html, body").animate({
                            scrollTop: target.offset().top - 80
                        },
                        500
                    );
                    return false;
                }
            }
        });




    
}(jQuery));
