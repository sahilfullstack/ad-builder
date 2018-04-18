<template>
    <form @submit.prevent="create">
        <div class="form-group">
            <label for="type">TYPE <span class="text-danger">*</span></label>
            <select name="type" id="type" class="form-control" v-model="form.type">
                <option value="ad">Ad</option>
                <option value="page">Landing Page</option>
            </select>
        </div>
        
        <div class="form-group" v-if="form.type == 'ad'">
            <label for="layout_id">LAYOUT <span class="text-danger">*</span></label>
            <select name="layout_id" id="layout_id" class="form-control" v-model="form.layout_id">
                <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">NAME <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Example: Half Page Ad Template" v-model="form.name">
        </div>

        <p><strong>COMPONENTS <span class="text-danger">*</span></strong></p>
        
        <div class="form-group">
            <div class="row" style="margin-bottom: 15px;" v-for="(component, index) in form.components" :key="index">
                <div class="col-md-5">
                    <select name="type" id="type" class="form-control" v-model="form.components[index]['type']">
                        <option value="text">Text</option>
                        <option value="image">Image</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="components" placeholder="Example: Cover Image" v-model="form.components[index]['name']">
                </div>
                <div class="col-md-2">
                    <a href class="btn btn-success" @click.prevent="addComponentAfterIndex(index)">+</a>
                    <a href class="btn btn-danger" @click.prevent="removeComponentAtIndex(index)" v-if="form.components.length > 1">-</a>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="disable.creating">Create</button>
    </form>
</template>

<script>
export default {
    props: {
        layouts: {
            type: Array,
            required: true
        },
        afterCreatePath: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: {
                type: 'ad',
                layout_id: null,
                name: '',
                components: [
                    {
                        type: 'text',
                        name: ''
                    }
                ]
            },
            errors: [],
            disable: {
                creating: false
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
        addComponentAfterIndex(index) {
            this.form.components.push({
                type: 'text',
                name: ''
            });
        },
        removeComponentAtIndex(index) {
            this.form.components.splice(index, 1);
        },
        create() {
            this.disable.creating = true;

            axios.post('/api/templates', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    window.location = this.afterCreatePath;
                })
                .catch(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;

                    console.log(response);
                });
        },
    }
}
</script>

