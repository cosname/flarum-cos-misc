'use strict';

System.register('cosname/misc/main', ['flarum/extend', 'flarum/components/SignUpModal'], function (_export, _context) {
    "use strict";

    var extend, SignUpModal;
    return {
        setters: [function (_flarumExtend) {
            extend = _flarumExtend.extend;
        }, function (_flarumComponentsSignUpModal) {
            SignUpModal = _flarumComponentsSignUpModal.default;
        }],
        execute: function () {

            app.initializers.add('cosname-misc', function () {

                extend(SignUpModal.prototype, 'content', function (vdom) {
                    vdom[0].children.splice(0, 0, m(
                        'h3',
                        null,
                        '\u6CE8\u610F\uFF1A\u8BF7\u907F\u514D\u4F7F\u7528QQ\u90AE\u7BB1\uFF0C\u5426\u5219\u53EF\u80FD\u65E0\u6CD5\u63A5\u6536\u6FC0\u6D3B\u90AE\u4EF6\u3002'
                    ));
                    return vdom;
                });
            });
        }
    };
});