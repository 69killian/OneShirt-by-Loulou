<template>
  <section class="visit-counter">
    <div>
      <img src="../../../public/images/counter.png" alt="counter-icon" />
    </div>
    <div class="visit-counter-info">
      <p class="visit-counter-number">100</p>
      <p class="real-time-visits-desc">Real Time Visits</p>
    </div>
  </section>
</template>

<script>
export default {
  name: 'VisitCounter',
};
</script>

<style scoped>
.visit-counter {
  border-top: rgb(197, 197, 197) solid 1px;
  padding: 70px 0px 50px 0px;
}

.visit-counter, .visit-counter-info {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

.visit-counter-number {
  font-weight: bold;
  font-size: 35px;
  margin-bottom: 0px;
}

.real-time-visits-desc {
  font-size: 18px;
  font-weight: 300;
  color: rgb(56, 56, 56);
}
</style>
