<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label >LAYOUT <span class="text-danger">*</span></label>
            <span v-if="layouts.length== 0">No Subscriptions Yet.</span>
            <select v-if="layouts.length > 0" name="layout_id" id="layout_id" class="form-control" v-model="form.layout_id">    
                <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
            </select>
            <br>
            <select v-if="children[form.layout_id] != undefined && children[form.layout_id].length > 0" name="child_id" id="child_id" class="form-control" v-model="form.child_id">    
                <option v-for="(child, key) in children[form.layout_id]" :key="key" :value="child.id">{{ child.name }}</option>
            </select>
            <span class="text-danger" :class="{'hidden': errors['layout_id'] == undefined}" style="margin-right:10px;">{{errors['layout_id']}}</span>
        </div>
        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>
        <button v-if="layouts.length > 0" type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
export default {
    props: {
        layouts: {
            type: Array,
            required: true
        },
        children: {
            type: Array,
            required: true
        },
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
            form: {
                layout_id: this.unit.layout_id == null ? (this.layouts.length > 0 ? this.layouts[0].id :0) : this.unit.layout_id,
                child_id: 0
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    watch: {
       'form.layout_id': function() {

            if(this.children[this.form.layout_id] != undefined) {
                this.form.child_id = 0;
            }

           if((this.children[this.form.layout_id] != undefined) && (this.children[this.form.layout_id].length >0)) {
                this.form.child_id = this.children[this.form.layout_id][0].id;
            }
        } 
    },


    methods: {
        update() {
            this.disable.saving = true;
            var self = this;
            
            this.errors = [];
console.log(this.form.layout_id);
            if(this.form.child_id != 0)
            {
                this.form.layout_id = this.form.child_id;            
            }

            console.log(this.form.layout_id);

            axios.put('/api/units/' + this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    window.location = this.redirectTo;
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                                            
                        self.errors[errorIndex] = error[0];
                        console.log(self.errors);
                    });
                });
        }
    },
    mounted(){  
           if((this.children[this.form.layout_id] != undefined) && (this.children[this.form.layout_id].length >0)) {
                this.form.child_id = this.children[this.form.layout_id][0].id;
            }
      }
                
}
</script>

