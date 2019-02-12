<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <img :src="photo" width="0" height="0" style="display: none;position:absolute">
                    <div class="panel-body" v-html="content"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                content: "",
                music: "",
                back: "",
                aUrl: "",
                photo:"",
            }
        },
        created: function () {
            let one = location.href.split('#', 5);
            let id = one[0].split('/',5)[4];
            axios.post('/getArticle/' + id).then(response => {
                this.content = response.data.content;
                this.photo = response.data.photo;
            });
        },
    }
</script>

<style>
    @-webkit-keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    #audio_btn img {
        -webkit-transform: rotate(360deg);
        animation: rotation 3s linear infinite;
        -moz-animation: rotation 3s linear infinite;
        -webkit-animation: rotation 3s linear infinite;
        -o-animation: rotation 3s linear infinite;
        margin: 0 0 0 0;
        float: none;
    }

    .panel-heading {
        margin-top: 20px;
    }

    img {
        width: 100%;
    }
</style>
