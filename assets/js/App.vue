<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      description: "",
      formSubmitted: false
    };
  },
  methods: {
    // refreshHello() {
    //   if (this.name) {
    //     fetch("/api/helloword/" + this.name, {"method": "GET"})
    //         .then(response => response.json())
    //         .then(result => this.hello = result);
    //   }
    // },
    submitForm: function (){
      if (this.name && this.email && this.description) {
        fetch("/api/contact", {
          "method": "POST",
          "headers": {
            "Content-Type": "application/json"
          },
          "body": JSON.stringify({
            "name": this.name,
            "email": this.email,
            "description": this.description
          })
        })
        .then(response => response.json())
        .then(result => this.formSubmitted = true);
      }
    }
    // submi: function () {
    //   fetch("/api/helloword/", { method: "POST", headers: { 'Content-Type' : 'application/json'}, body: {
    //     name: this.name,
    //       email: this.email,
    //       description: this.description
    //     }})
    //       .then(function(response){
    //         return response.json();
    //       }).then(function(text){
    //     console.log(text);
    //   }).catch(function (error){
    //     console.error(error);
    //   })
    //   this.formSubmitted = true
    // }
  }
}
</script>

<template>
<!--  <input type="text" v-model="name">-->
<!--  <button @click="refreshHello">Demander un bonjour !</button>-->
<!--  <h1 v-show="!!hello">{{ hello }}</h1>-->
  <form @submit.prevent="submitForm" v-if="!formSubmitted">
    <span>Full Name</span><br>
    <input
        v-model="name"
        type="text"
        placeholder="Enter your name"
    /><br>
    <span>Email</span><br>
    <input
        v-model="email"
        type="email"
        placeholder="Enter your email"
    /><br>
    <span>Description</span><br>
    <input
        v-model="description"
        type="text"
        placeholder="Enter your description"
    /><br>
    <input
        class="submit"
        type="submit"
        value="Submit"
    >
  </form>
  <div v-if="formSubmitted">
    <h3>Form Submitted</h3>
    <p>Name: {{ name }}</p>
    <p>Email: {{ email }}</p>
    <p>Gender: {{ description }}</p>
  </div>
</template>

<!--connect vue to template twig-->
