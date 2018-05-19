<template>
    <form @submit.prevent="update">
        <div class="form-group">
            <label for="name">Full Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Full Name" v-model="form.name">
            <span class="text-danger" :class="{'hidden': errors['name'] == undefined}" style="margin-right:10px;">{{errors['name']}}</span>
        </div>
        <div class="form-group">
            <label for="company">Company <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="company" placeholder="Company" v-model="form.company">
            <span class="text-danger" :class="{'hidden': errors['company'] == undefined}" style="margin-right:10px;">{{errors['company']}}</span>
        </div>
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="email" placeholder="email" v-model="form.email">
            <span class="text-danger" :class="{'hidden': errors['email'] == undefined}" style="margin-right:10px;">{{errors['email']}}</span>
        </div>
        <div class="form-group">
            <label for="phone">Phone<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone" placeholder="phone" v-model="form.phone">
            <span class="text-danger" :class="{'hidden': errors['phone'] == undefined}" style="margin-right:10px;">{{errors['phone']}}</span>
        </div>
        <div class="form-group">
            <label>Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Username" :disabled="true" v-model="form.username">
            <span class="text-danger" :class="{'hidden': errors['username'] == undefined}" style="margin-right:10px;">{{errors['username']}}</span>
        </div>
        
        <hr />

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

        <button type="submit" class="btn btn-primary" :disabled="disable.updating">Update</button>
    </form>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            form: {
                name: this.user.name,
                company: this.user.company,
                email: this.user.email,
                phone: this.user.phone,
                username: this.user.username
            },
            errors: [],
            disable: {
                updating: false
            }
        }
    },

    computed: {
        selectedType() {
            return this.form.type;
        }
    },

    watch: {
        selectedType(current, previous) {
            Vue.set(this.form, 'layout_id', null);
        } 
    },

    methods: {
        update() {
            this.disable.updating = true;
            var self = this;

            this.errors = [];

            axios.put('/api/users/'+ self.user.id +'/profile', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.updating = false;

                    location.reload();
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.updating = false;
                   
                    _.forEach(error.response.data.errors, function(error, index) {
                        console.log(self.errors);
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                        
                        self.errors[errorIndex] = error[0];
                    });
                });
        },
    }
}
</script>

