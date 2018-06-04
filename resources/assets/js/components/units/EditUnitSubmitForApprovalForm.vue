<template>
    <form @submit.prevent="update">
        <h4>SUBMIT FOR APPROVAL</h4>
        <p>Make sure that you've completed all the fields before submitting it for approval.</p>            
         <div class="form-group">
            <label for="date" class="control-label h5">Scheduled Date</label>
            <date-picker v-model="scheduled_at" lang="en"></date-picker>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:30px;">{{errors['general']}}</span>
        <a v-bind:href="errors['url']" class="btn btn-danger" :class="{'hidden': errors['url'] == undefined}">Fix It</a>
        <br>
        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Submit</button>
    </form>
</template>

<script>
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
            scheduled_at: moment(new Date())._d,
            form: {
                
            },
            errors: [],
            disable: {
                saving: false
            }
        }
    },

    methods: {
        update() {
            this.disable.saving = true;
            var self = this;
            
            this.errors = [];

            axios.put('/api/units/' + this.unit.parent_id + '/publish', {
                scheduled_at: new Date(this.scheduled_at.getTime() - (this.scheduled_at.getTimezoneOffset() * 60000)).toISOString().substring(0, 10)
            })
                .then(response => {  
                    window.location.href = '/units?type=ad';                  
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var baseUrl = 'http://mesa.app';

                        var url = '';
                        console.log(index);
                        switch(index)
                        {
                            case "parent_components":
                                url = '/units/'+self.unit.parent_id+'/edit?section=components';
                                break;
                            case "parent_layout":
                                url = '/units/'+self.unit.parent_id+'/edit?section=layout';
                                break;
                             case "parent_template":
                                url = '/units/'+self.unit.parent_id+'/edit?section=template';
                                break;
                             case "parent_name":
                                url = '/units/'+self.unit.parent_id+'/edit?section=basic';
                                break;
                            case "components":
                                url = '/units/'+self.unit.id+'/edit?section=components';
                                break;
                             case "template":
                                url = '/units/'+self.unit.id+'/edit?section=template';
                                break;
                             case "name":
                                url = '/units/'+self.unit.id+'/edit?section=basic';
                                break;
                            case "general":
                                url = undefined;
                                break;
                            default:
                                url = "";
                                break;

                        }

                        self.errors['url'] = url;
                        self.errors['general'] = error[0];  
                        console.log(self.errors);                  
                    });
                });
        }
    }
}
</script>

