<template>
  <div>
    <span class="like-btn" @click="likeReceta" :class="{'like-active' : this.like}"></span>
    <p>{{cantidadLikes}} Les gusto esta receta </p>
  </div>
</template>

<script>

    export default {
        props:['recetaId', 'like', 'likes'],
        data:function(){
            return{
                totalLikes: this.likes
            }
            
        },
        methods:{
            likeReceta(){
                axios.post('/recetas/'+this.recetaId)
                .then(respuesta => {
                    if(respuesta.data.attached.length>0){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }
                })
                    .catch(error => {
                        if(error.response.status == 401){
                            this.$swal({
                            icon: 'error',
                            iconColor:'#00d8ff',
                            title: 'Oops...',
                            text: 'Aun no eres usuario para dar like!',
                            footer: '<a href="/register">>>Registrate aqui<<</a>'
                            })
                        }
                    });
                }
            },
            computed:{
                cantidadLikes: function(){
                    return this.totalLikes;
                }
            }
        }
    
</script>
