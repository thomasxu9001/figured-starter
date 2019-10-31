<template>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <ul>
                <li v-for="error in errors">
                    {{error}}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            errors: Array,
        }
    }
</script>
