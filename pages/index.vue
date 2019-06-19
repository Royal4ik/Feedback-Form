<template>
  <section class="container">
    <div class="feedback-form">
    <div class="feedback-title">
      <h1 class="title">
        Форма обратной связи
      </h1>
    </div>
    <form @submit.prevent="send"  
      method="POST"  v-on:click="focusForm">
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="name">Имя</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input class="input" type="text" name="name" id="name" v-model="name" :class="{'is-danger': errorName > 1}" v-on:change="nameInput($event)">
            </div>
            <p class="help is-danger" v-if="errorName == 2">
                Укажите имя!
            </p>
            <p class="help is-danger" v-else-if="errorName == 3">
                Укажите корректное имя!
            </p>
          </div>
        </div>
      </div>
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="email">Электронный адрес</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <input class="input" type="text" name="email" id="email" v-model="email" :class="{'is-danger': errorEmail > 1}" v-on:change="emailInput($event)">
            </div>
            <p class="help is-danger" v-if="errorEmail == 2">
                Укажите электронную почту!
            </p>
            <p class="help is-danger" v-else-if="errorEmail == 3">
                Укажите корректный адрес электронной почты!
            </p>
          </div>
        </div>
      </div>
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label" for="phone">Номер телефона</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <masked-input
                type="text"
                name="phone"
                id="phone"
                class="form-control input"
                v-on:change="phoneInput($event)"
                v-model="phone"
                :class="{'is-danger': errorPhone > 1}"
                :mask="['+', /\d/, ' ', '(', /[1-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]"
                placeholder="+"
                >
              </masked-input>
            </div>
            <p class="help is-danger" v-if="errorPhone == 2">
              Укажите телефон!
            </p>
          </div>
        </div>
      </div>
      <div class="field is-grouped is-grouped-centered ">
        <div class="control">
          <button type="submit" value="Submit" class="button is-primary is-medium" :disabled="(errorEmail > 0) || (errorName > 0) || (errorPhone > 0)">Отправить</button>
        </div>
      </div>
      <p class="help is-success" v-if = "isSend">Форма отправлена! </p>
    </form>
    </div>
  </section>
</template>

<script>
import Vue from 'vue'
import MaskedInput from 'vue-text-mask'
import axios from 'axios'

export default {
  components: {
    MaskedInput,
    axios
  },
  data:function() {
  return {
    errorEmail: 1,
    errorName: 1,
    errorPhone: 1,
    isSend: false,
    name:null,
    email:null,
    phone:null
  };
},
  methods: {
    send: function (e) {
      e.preventDefault();

      axios.post(
        "https://formfor.site/send/ZLod9Sq27iwcsnmW5SO7EshouY9Far",
        { name: this.name, email: this.email, phone: this.phone}
      );
      
      this.formClear();
      this.isSend = true;
    },

    focusForm: function(e)
    {
      this.isSend = false;
    },

    phoneInput: function(e)
    {
      if (!this.phone || this.phone[this.phone.length-1] == "_") {
        this.errorPhone = 2;
      }
      else{
        this.errorPhone = 0;
      }
    },

    emailInput: function(e)
    {
      if (!this.email) {
        this.errorEmail = 2;
      } else if (!this.validEmail(this.email)) {
        this.errorEmail = 3;
      }
      else{
        this.errorEmail = 0;
      }
    },

    nameInput: function(e)
    {
      if (!this.name) {
        this.errorName = 2;
      }
      else if (!this.validName(this.name)) {
        this.errorName = 3;
      }
      else
      {
        this.errorName = 0;
      }
    },

    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,6}))$/;
      return re.test(email);
    },

    validName: function (name) {
      var re = /^[a-zA-Zа-яёА-ЯЁ-]+$/;
      return re.test(name);
    },

    formClear: function(){
      this.phone="";
      this.name="";
      this.email="";
      this.errorEmail=1;
      this.errorName=1;
      this.errorPhone=1;
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

