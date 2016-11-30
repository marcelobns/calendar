<style media="screen">
ul.days li:nth-child(-n+<?=$this->first_day?>) {
    outline: none;
    color: #eee;
}
</style>
<div class="col-sm-12 header">
    <!-- <h4>Controle de Salas</h4> -->
</div>
<div class="col-sm-9">
    <div class="form-group">
        <?php $this->input('select', 'page[group]', 'class="form-control"', $this->data['groups'], false); ?>
    </div>
    <div class="calendar">
        <div class="month">
          <ul>
            <li class="prev"><a href="#">&#10094;</a></li>
            <li class="next"><a href="#">&#10095;</a></li>
            <li class="selected-month">
                <?=date('M Y', strtotime($this->month))?>
            </li>
          </ul>
        </div>
        <ul class="weekdays">
          <li><span class="hidden-md-down">Domingo</span><span class="hidden-lg-up">Dom</span></li>
          <li><span class="hidden-md-down">Segunda</span><span class="hidden-lg-up">Seg</span></li>
          <li><span class="hidden-md-down">Terça</span><span class="hidden-lg-up">Ter</span></li>
          <li><span class="hidden-md-down">Quarta</span><span class="hidden-lg-up">Qua</span></li>
          <li><span class="hidden-md-down">Quinta</span><span class="hidden-lg-up">Qui</span></li>
          <li><span class="hidden-md-down">Sexta</span><span class="hidden-lg-up">Sex</span></li>
          <li><span class="hidden-md-down">Sábado</span><span class="hidden-lg-up">Sab</span></li>
        </ul>
        <ul class="days">
            <?php foreach ($this->days as $i=>$day) : ?>
                <li <?= ($this->today == $this->month."-".$day ? "class='today'" : "") ?>>
                    <?= ($day<=0? "." : $day) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<div class="col-sm-3">
    <h5>Livres</h5>
    <ul class="salas">
        <?php foreach ($this->data['livres'] as $i=>$sala) : ?>
            <li><span style="background-color: <?=$sala->color?>"></span> <?=$sala->name?></li>
        <?php endforeach ?>
    </ul>
    <h5>Ocupadas</h5>
</div>
