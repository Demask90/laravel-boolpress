<template>
    <main class="row col-12">
        <div>
            <ol>
                <h2>Elenco Post:</h2>
                <li v-for="post in posts" :key="post.id">
                    {{ post.title }}
                </li>
            </ol>
        </div>
    </main>
</template>

<script>
    export default {
       name: 'Main',
       data() {
           return {
            // mi definisco la url di riferimento da richiamare con axios
                url: 'http://127.0.0.1:8000/api/posts',
                // un array per andarlo a popolare con i dati della chiamata
                posts: [],
                // ora lo definisco statico(ho inserito il mio api_token relativo al mio account) ma è più corretto rendere dinamica la variabile api_token assegnandoli l'API TOKEN relativo all'utente loggato
                api_token: 'vkIr9pgfM4L2k4aBUrsp7MHxBXL9e6xuEHhvQeoeZt1tZx8gxY8uzDm2nUuza1nyHpKmj5XWn4JmC5X9',
            }
       },
       created() {
        // elabora il metodo getPosts in fase create (life circle vue)
           this.getPosts();
       },
       methods: {
        // posso effettuare la chiamata axios direttamente in quanto definita in front.js
           getPosts() {
            //    mi definisco una costante con la configurazione della autorizzazione headers che richiede la concatenazione della parola Bearer e del api_token definito nei data
               const config = {
                   headers: {Authorization: `Bearer ${this.api_token}`}
               };
            //  devo definirmi nella const bodyParameters una chiave valore
               const bodyParameters = {
                   key: "value"
               };

            //PER SALVARE IL BEARER API_TOKEN, DEVO MODIFICARE LA CHIAMATA AXIOS DA .GET A .POST E AGGIUNGERE COME PARAMETRI LE COSTANTI (CONFIG E BODYPARAMETERS)
               axios.post(this.url, bodyParameters, config)
                    .then(response => {
                        // console.log(response.data.results);
                        this.posts = response.data.results;
                    })
                    .catch();
           }
       }
    }
</script>

