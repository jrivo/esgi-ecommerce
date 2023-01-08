<template>
   <div className="pageNotFound">
      <h1>La page que vous cherchez n'existe pas</h1>
    </div>
</template>

<script>
export default {
    name: 'PageNotFound'
}
</script>

<style>
@media (min-width: 1024px) {
  .pageNotFound {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>