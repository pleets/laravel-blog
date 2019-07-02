<template>
<pre><code :class="language">{{ content }}
</code></pre>
</template>

<script>
    export default {
        props: ['language', 'content']
    }
</script>