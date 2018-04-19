<template>
    <div>
        <h4>BUILD LANDING PAGE</h4>
        <p>Every ad must have a landing page. Click below to start building the landing page now.</p>

        <a :href="'/units/' + this.unit.id + '/edit/page'" class="btn btn-primary">Build Landing Page</a>
    </div>
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
    }
}
</script>

