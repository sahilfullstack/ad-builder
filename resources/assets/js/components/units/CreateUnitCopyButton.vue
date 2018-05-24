<template>
  <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.copying">Make a Copy</a>
</template>

<script>
import ConfirmModal from './../ConfirmModal';
export default {
    props: {    
       unit: {
            type: Object,
            required: true
        },
        redirectTo: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            disable: {
                copying: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            Modal.show(ConfirmModal, {
                propsData: {
                        message:'Do you really want to make a copy of this ad?',
                        unit: this.unit
                    }
                })
                .then(function(url) {
                    thiz.disable.copying = true;
                    axios.post('/api/units/' + thiz.unit.id + '/copy',  {})
                    .then(function (response) {
                        thiz.disable.copying = false;

                        // go to list units
                        window.location = thiz.redirectTo;
                    })
                    .catch(function (error) {
                        thiz.disable.copying = false;
                        console.log(error);
                    });
                    
                });
        }
    }
}
</script>

