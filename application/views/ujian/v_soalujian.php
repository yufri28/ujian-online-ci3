<?php
$this->load->view('ujian/head');
?>

<!--tambahkan custom css disini-->
<style>
#timer_place {
    margin: 0 auto;
    text-align: center;
}

#counter {
    border-radius: 7px;
    border: 2px solid gray;
    padding: 7px;
    font-size: 2em;
    font-weight: bolder;
}

.question {
    display: none;
}
</style>
<?php
$this->load->view('ujian/topbar');
?>

<?php

if(isset($_SESSION["waktu_start"])){
    $lewat = time() - $_SESSION["waktu_start"];
}else{
    $_SESSION["waktu_start"] = time();
    $lewat = 0;
}

?>
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header text-center">
                    <h4 class="box-title">Waktu Anda</h4>
                </div>
                <div class="box-body" id="timer_place">
                    <span id="counter" align="center"></span>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <center>
                        <h3 class="box-title">Soal Ujian</h3>
                    </center>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow-y: scroll; height: 100%;">
                    <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian/jawab_aksi"
                        method="post" onsubmit="return confirm('Anda Yakin ?')">

                        <input type="hidden" name="id_peserta" value="<?php echo $id['id_peserta']; ?>">
                        <input type="hidden" id="total_soal" name="jumlah_soal" value="<?php echo $total_soal; ?>">

                        <div id="list">
                            <?php
                            $i = 0; 
                            $no = 0;
                            foreach ($soal as $s) {
                                $no++; 
                            ?>
                            <div class="question" data-page="<?= $no < 11 ? 1:2;?>">
                                <div class="form-group">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td width="1%"><?php echo $no; ?>.</td>
                                                <td><?php echo $s->pertanyaan; ?>
                                                    <input type='hidden' name='soal[]'
                                                        value='<?php echo $s->id_soal_ujian; ?>' />
                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]"
                                                        value="A" required /> <?php echo $s->a; ?><br>
                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]"
                                                        value="B" required /> <?php echo $s->b; ?><br>
                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]"
                                                        value="C" required /> <?php echo $s->c; ?><br>
                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]"
                                                        value="D" required /> <?php echo $s->d; ?><br>
                                                    <input type="radio" name="jawaban[<?php echo $s->id_soal_ujian; ?>]"
                                                        value="E" required /> <?php echo $s->e; ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <?php } ?>
                        </div>

                    </form>
                </div>
                <div class="box-footer">
                </div>
            </div><!-- /.box-body -->
            <div id="pagination">
                <button id="nextBtn" class="btn btn-info btn-flat pull-right">Selanjutnya</button>
                <button id="prevBtn" class="btn btn-info btn-flat pull-right">Sebelumnya</button>
                <!-- <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button> -->
                <div id="data-container"></div>
                <div id="pagination-container"></div>
            </div>
            <ul class="listPage">

            </ul>
        </div>
    </div>
    </div>




</section><!-- /.content -->

<?php
$this->load->view('ujian/js');
?>
<script>
const questions = document.querySelectorAll('.question');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const total_soal = document.getElementById('total_soal').value;
const numPage = total_soal / 3;

let currentPage = 1;

function showPage(pageNumber) {
    questions.forEach(question => {
        if (question.getAttribute('data-page') === pageNumber.toString()) {
            question.style.display = 'block';
        } else {
            question.style.display = 'none';
        }
    });
}

function updateButtons() {
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === numPage;
}

prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
        updateButtons();
    }
});

nextBtn.addEventListener('click', () => {
    if (currentPage < numPage) {
        currentPage++;
        showPage(currentPage);
        updateButtons();
    }
});

showPage(currentPage);
updateButtons();
</script>
<script type="text/javascript">
// var countDownDate = new Date("").getTime();
// var x = setInterval(function() {
//     var now = new Date().getTime();
//     var distance = countDownDate - now;
//     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//     hours = hours < 10 ? "0" + hours : hours;
//     minutes = minutes < 10 ? "0" + minutes : minutes;
//     seconds = seconds < 10 ? "0" + seconds : seconds;
//     document.getElementById("counter").innerHTML = hours + ":" + minutes + ":" + seconds;
//     if (distance < 0) {
//         document.getElementById("counter").innerHTML = "WAKTU UJIAN HABIS";
//         document.getElementById("formSoal").submit();
//     }
// }, 1000);
function waktuHabis() {
    alert('Waktu Anda telah habis, Jawaban anda akan disimpan secara otomatis.');
    var formSoal = document.getElementById("formSoal");
    formSoal.submit();
}

function hampirHabis(periods) {
    if ($.countdown.periodsToSeconds(periods) == 60) {
        $(this).css({
            color: "red"
        });
    }
}
$(function() {
    var waktu = '<?= $max_time; ?>';
    var sisa_waktu = waktu - <?php echo $lewat ?>;
    var longWayOff = sisa_waktu;
    $("#counter").countdown({
        until: longWayOff,
        compact: true,
        onExpiry: waktuHabis,
        onTick: hampirHabis
    });
});


window.location.hash = "no-back-button";
window.location.hash = "Again-No-back-button";
window.onhashchange = function() {
    window.location.hash = "no-back-button";
}
</script>


<?php
$this->load->view('ujian/foot');
?>