<?php get_header(); ?>
<section class="main services-page">
  <div class="container">
    <div class="services-page__wrapper">
      <div class="services-page__item">
        <h1 class="services-page-title">
          <?php the_archive_title(); ?>
        </h1>
        <?php get_template_part('template-parts/serviсe-page'); ?>
      </div>
      <div class="services-page__item">
        <?php get_template_part('template-parts/serviсe-form'); ?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="services-page__notes">
      <div class="services-page__notes-wrapper">
        <p class="services-page__notes-item">Примечания:</p>
        <p class="services-page__notes-item">
          *при записи на курс в течение 10 дней после проведения диагностики/первичной консультации скидка на первый абонемент 10%
        </p>
        <p class="services-page__notes-item">
          *при изменении длительности, формата, количества занятий по рекомендации специалиста стоимость занятия/абонемента рассчитывается индивидуально
        </p>
      </div>
    </div>
  </div>

  <?php get_template_part('template-parts/service-page-consultation'); ?>
</section>
<?php get_footer(); ?>