<template>
    <a :href="link" @click.prevent="destroy" class="btn btn-sm btn-danger" title="delete" rel="nofollow" ><i class="fa fa-trash-o"></i></a>
</template>

<script>
    export default {
        name: "LinkDestroyComponent",
        props: {
            link: {
                type: String,
                required: true
            },
            lineId: {
                type: String,
                required: false
            }
        },
        methods: {
            destroy() {

                let lineId = this.lineId;
                let link = this.link;
                console.log("this.link = " + link);
                console.log("this.lineId = " + lineId);

                if (confirm('Confirms removal of this record??')) {

                    axios.delete(link)
                        .then(function (response) {

                            console.log(response);
                            if (lineId) {
                                showMessage('s', 'Successfully removed');
                                $('#' + lineId).remove();
                            } else {

                                document.location.reload(true);
                            }

                        })
                        .catch(function (error) {
                            showMessage('w', 'Não foi possível realizar a remoção');
                            console.error(error);
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>
