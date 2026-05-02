<script setup>
import { onMounted, ref } from 'vue'

let topics = ref([])
onMounted(() => {
  // fetching config
  fetch('http://localhost/main.php')
    .then(r => r.json())
    .then(r => {
      console.log(r)
      topics.value = r.topics
      console.log(topics.value)
    })
})

const formState = ref({
  topic: null,
  comments: null
})

function submitForm() {
  const place = localStorage.getItem('place')
  const poll = {place, ...formState.value}

  console.log(poll)

  fetch('http://localhost/post.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(poll)
  })
    .then(r => r.json())
    .then(r => {
      console.log(r)
    })
}
</script>

<template>
  <main class="cont">
    <div class="c">
      <h1 class="title">Желаемая тема для личного проекта на открытом уроке</h1>
      <p class="i" style="margin-top: 0; margin-bottom: 3rem; font-size: .9em">(опрос анонимный)</p>
    </div>

    <form @submit.prevent="submitForm">
      <div class="form-field">
        1. Какую программу ты хочешь использовать для своего проекта?
        <ul>
          <li v-for="topic of topics">
            <label>
              <input v-model="formState.topic" :value="topic" type="radio" name="topic" required>
              {{ topic }}
            </label>
          </li>
        </ul>
      </div>

      <div style="margin-bottom: 3rem;">
        2. Комментарий (необязательно):<br>
        <p class="any-comments" style="margin-top: .3rem; padding-left: 1.1rem; background-color: gray; color: white; font-style: italic;">
          У тебя есть какие-то мысли насчёт личного проекта? Можешь тут поделиться.<br>
          Может, хочется сделать несколько проектов? Опиши свои пожелания.
        </p>
        <textarea v-model="formState.comments" class="textarea"></textarea>
      </div>

      <button class="btn form-btn" type="submit">Отправить</button>
    </form>
  </main>
</template>