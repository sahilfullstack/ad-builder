<template>
    <div>
      <a href @click.prevent="create" class="btn btn-sm btn-success" :disabled="disable.copying">Make a Copy</a>
        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
    </div>
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
           errors: [],
            disable: {
                copying: false
            }
        }
    },

    methods: {
        create() {
            let thiz = this;
            this.errors = [];
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
                        // go to edit unit
                        window.location =  thiz.redirectTo.replace("units", "units/"+response.data.id+"/edit?section=layout");
                    })
                    .catch(function (error) {
                        thiz.disable.copying = false;
                        _.forEach(error.response.data.errors, function(error, index) {
                            console.log(thiz.errors);
                            var errorIndex = _.startsWith(index, '_')
                                                ? _.trim(index, '_')
                                                : index;
                            
                            thiz.errors[errorIndex] = error[0];
                        });
                    });                    
                });
        }
    }
}
</script>

