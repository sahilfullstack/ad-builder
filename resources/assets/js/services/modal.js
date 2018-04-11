class Modal {

    constructor(modalComponent) {
        this.modalComponent = modalComponent;
        this.modalConstructor = Vue.extend(modalComponent);
    }

    static show(modalComponent, config = {}) {
        // preparing the stage
        $('body').append('<div class="modalContainer"></div>');

        let instance = new Modal(modalComponent);
        return new Promise((resolve, reject) => {
            let modal = new instance.modalConstructor(config).$mount($('.modalContainer')[0]);

            $(modal.$el).on('hidden.bs.modal', function (event) {
                instance.destroy(modal);
            });

            modal.$on('resolve', function (unit) {
                resolve(unit);
                instance.destroy(modal);
            });

            modal.$on('reject', function (error) {
                reject(error);
                instance.destroy(modal);
            });

            instance.show(modal);
        });
    }

    show(modal) {
        $(modal.$el).modal('show');
    }

    hide(modal) {
        $(modal.$el).modal('hide');
        if ($('.modal:visible').length > 0) {
            $('body').addClass('modal-open');
        }
    }

    destroy(modal) {
        this.hide(modal);
        modal.$el.remove();
        modal = undefined;
    }

}

export default Modal;