$(document).ready(function () {
    function sizes() {
        var heightR = $(window).height();// высота экрана
        var widthR = $(window).width();// ширина экрана
        $('body .header').css({'width': widthR, 'height': heightR * 0.06});
        $('body .content').css({'width': widthR, 'height': heightR * 0.94});
    }

    sizes();
    $(window).resize(function () {
        sizes()
    });

    function makeEaseOut(timing) {
        return function (timeFraction) {
            return 1 - timing(1 - timeFraction);
        }
    }

    function bounce(timeFraction) {
        for (var a = 0, b = 1, result; 1; a += b, b /= 2) {
            if (timeFraction >= (7 - 4 * a) / 11) {
                return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2)
            }
        }
    }

    var bounceEaseOut = makeEaseOut(bounce);
    getUp('#left', 88, 180);
    getUp('#center', 73, 120);
    getUp('#right', 76, 150);

    function animate(options) {
        var start = performance.now();
        requestAnimationFrame(function animate(time) {
            // timeFraction от 0 до 1
            var timeFraction = (time - start) / options.duration;
            if (timeFraction > 1) timeFraction = 1;

            // текущее состояние анимации
            var progress = options.timing(timeFraction);

            options.draw(progress);

            if (timeFraction < 1) {
                requestAnimationFrame(animate);
            }

        });
    }

    function getUp(mountain, top, bottom) {
        animate({
            duration: 1300,
            timing: bounceEaseOut,
            draw: function (progress) {
                $(mountain).css('top', (progress * (top - bottom) + bottom) + '%')
            }
        });
    }
});


