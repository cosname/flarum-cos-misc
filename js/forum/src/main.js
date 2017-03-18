import { extend } from 'flarum/extend';
import SignUpModal from 'flarum/components/SignUpModal';

app.initializers.add('cosname-misc', function() {

    extend(SignUpModal.prototype, 'content', function(vdom) {
        vdom[0].children.splice(0, 0,
            <h3>注意：请避免使用QQ邮箱，否则可能无法接收激活邮件。</h3>
        );
        return vdom;
    });

});
