<template>
  <section class="container">
    <div class="feedback-form">
    <div class="feedback-title">
      <h1 class="title">
        Форма обратной связи
      </h1>
    </div>

    <b-form class="contact-form" @submit.prevent="send"  
      method="POST"  v-on:click="focusForm">
        <b-form-group 
          id="input-group-name" 
          class = "label-weight" 
          label-cols="5" 
          label-align-sm="right" 
          label-cols-lg="3"  
          label="Имя: " 
          label-for="name"
          >
          <b-form-input id="name" v-model="name" :state="nameValidState" aria-describedby="input-name-feedback"
        type="tel">  </b-form-input>
          <b-form-invalid-feedback id="input-name-feedback" >
            Введите имя!
          </b-form-invalid-feedback>
        </b-form-group>    

        <b-form-group 
          id="input-group-email" 
          class = "label-weight" 
          label-cols="5" 
          label-align-sm="right" 
          label-cols-lg="3"  
          label="Электронный адрес: " 
          label-for="email"
          >
          <b-form-input id="email" v-model="email" :state="emailValidState" aria-describedby="input-email-feedback"
        >  </b-form-input>
          <b-form-invalid-feedback id="input-email-feedback" >
            Укажите корректный адрес электронной почты!
          </b-form-invalid-feedback>
        </b-form-group> 

        <b-form-group 
          id="input-group-phone" 
          class = "label-weight" 
          label-cols="5" 
          label-align-sm="right" 
          label-cols-lg="3"  
          label="Номер телефона: " 
          label-for="phone"
          >
          <b-form-input id="phone" v-model="phone" :state="phoneValidState" aria-describedby="input-phone-feedback" v-mask="'+# (###) ###-##-##'"
        placeholder="+"
        >  </b-form-input>
          <b-form-invalid-feedback id="input-phone-feedback" >
            Укажите корректный телефонный номер!
          </b-form-invalid-feedback>
        </b-form-group>
      <div class="field is-grouped is-grouped-centered ">
        <div class="control">
          <button type="submit" value="Submit" class="button is-primary is-medium" :disabled="!phoneValidState || !emailValidState || !nameValidState">Отправить</button>
        </div>
      </div>
      <p class="help is-success" v-if = "isSend">Форма отправлена! </p>
    </b-form>
    </div>
  </section>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import VueMask from 'v-mask'
Vue.use(VueMask);

export default {
  components: {
    axios
  },
  
  data:function() {
    return {
      isSend: false,
      name:undefined,
      email:undefined,
      phone:""
      };
  },

computed: {
    nameValidState() {
      if (typeof this.name == "undefined")
      {
        return null;
      }
      else if (!this.name)
      {
        console.log(this.name)
        return false;
      }

      return true;
    },

    phoneValidState() {
      let lengthValid = true

      const numbers = this.phone.match(/\d/g)
      if (numbers) {
        lengthValid = numbers.join('').length === 11
      }

      return this.phone && lengthValid
    },

    emailValidState() {
      if (typeof this.email == "undefined")
      {
        return null;
      }
      else if (!this.email || !this.validEmail(this.email))
      {
        console.log(this.name)
        return false;
      }

      return true;
    }
},

  methods: {
    send: function (e) {
      e.preventDefault();

      this.$axios.$post(
        "https://formfor.site/send/ZLod9Sq27iwcsnmW5SO7EshouY9Far",
        { name: this.name, email: this.email, phone: this.phone}
      );
      
      this.clearForm();
      this.isSend = true;
    },

    focusForm: function(e)
    {
      this.isSend = false;
    },

    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,6}))$/;
      return re.test(email);
    },

    clearForm: function(){
      this.phone="";
      this.name=undefined;
      this.email=undefined;
    }
  }
}
</script>

<style>

.container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 400;
  font-size: 50px;
  color: #000000;
  letter-spacing: 1px;
  margin-bottom: 60px;
}

.label-weight{
  font-weight: 700;
}

.feedback-form{
  width: 46vw;
  border-style: solid;
  border-width: 2px;
  border-radius: 5px;
  border-color: #00d1b2;
  padding: 20px;
  text-align: center;
}

.field:not(:last-child) {
    margin-bottom: 2.00rem;
}

.field-body{
  flex-grow: 4;
}

.help.is-success {
    font-size: 1.2rem;
}

.help
{
  font-size: 0.9rem;
}
</style>

