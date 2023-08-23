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

.hidden {
    display: none;
}

.pagination-container {
    width: calc(100% - 2rem);
    display: flex;
    align-items: center;
    /* position: absolute; */
    bottom: 0;
    padding: 1rem 0;
    justify-content: center;
}

li {
    list-style: none;
    margin-left: -35px;
}

.pagination-number,
.pagination-button {
    font-size: 1.1rem;
    background-color: transparent;
    border: none;
    margin: 0.25rem 0.25rem;
    cursor: pointer;
    /* height: 2.5rem;
    width: 2.5rem; */
    border-radius: 0.2rem;
}

.pagination-number:hover,
.pagination-button:not(.disabled):hover {
    background: #fff;
}

.pagination-number.active {
    color: #fff;
    background: #0085b6;
}

#save-button {
    color: #fff;
    background: #0085b6;
    font-size: 1.1rem;
    border-radius: 0.2rem;
}


label {
    font-weight: normal;
}

label,
input {
    cursor: pointer;
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
                <div class="box-body" style="overflow-y: scroll; height: 75vh;">
                    <form id="formSoal" role="form" action="<?php echo base_url(); ?>ruang_ujian/jawab_aksi"
                        method="post" onsubmit="return confirm('Anda Yakin ?')">

                        <input type="hidden" name="id_peserta" value="<?php echo $id['id_peserta']; ?>">
                        <input type="hidden" id="total_soal" name="jumlah_soal" value="<?php echo $total_soal; ?>">

                        <ul id="paginated-list" data-current-page="1" aria-live="polite">
                            <?php
                            $i = 0; 
                            $no = 0;
                            foreach ($soal as $s) {
                                $no++; 
                            ?>
                            <li>
                                <div class="form-group">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td width="1%"><?php echo $no; ?>.</td>
                                                <td>
                                                    <?php echo $s->pertanyaan; ?><br>
                                                    <input type='hidden' name='soal[]'
                                                        value='<?php echo $s->id_soal_ujian; ?>' />
                                                    <label>
                                                        <input type="radio"
                                                            name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="A"
                                                            required /> <?php echo $s->a; ?>
                                                    </label><br>
                                                    <label>
                                                        <input type="radio"
                                                            name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="B"
                                                            required /> <?php echo $s->b; ?>
                                                    </label><br>
                                                    <label>
                                                        <input type="radio"
                                                            name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="C"
                                                            required /> <?php echo $s->c; ?>
                                                    </label><br>
                                                    <label>
                                                        <input type="radio"
                                                            name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="D"
                                                            required /> <?php echo $s->d; ?>
                                                    </label><br>
                                                    <label>
                                                        <input type="radio"
                                                            name="jawaban[<?php echo $s->id_soal_ujian; ?>]" value="E"
                                                            required /> <?php echo $s->e; ?>
                                                    </label>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <button type="submit" id="save-button"
                            class="btn btn-primary btn-flat pull-right">Selesai</button>
                    </form>
                </div>
                <div class="box-footer">
                </div>
            </div>
            <nav class="pagination-container">
                <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                    Sebelumnya
                </button>
                <div id="pagination-numbers">
                </div>
                <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                    Selanjutnya
                </button>
            </nav>
        </div>
    </div>
</section>
<?php
$this->load->view('ujian/js');
?>

<script type="text/javascript">
const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");
const listItems = paginatedList.querySelectorAll("li");
const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");
const saveButton = document.getElementById("save-button");

const paginationLimit = 10;
const pageCount = Math.ceil(listItems.length / paginationLimit);
let currentPage = 1;

const disableButton = (button) => {
    button.classList.add("disabled");
    button.setAttribute("disabled", true);
};

const enableButton = (button) => {
    button.classList.remove("disabled");
    button.removeAttribute("disabled");
};

const hiddenButton = () => {
    saveButton.style.display = "none";
}

const showButton = () => {
    saveButton.style.display = "block";
}


const handlePageButtonsStatus = () => {
    if (currentPage === 1) {
        disableButton(prevButton);
    } else {
        enableButton(prevButton);
    }

    if (pageCount === currentPage) {
        disableButton(nextButton);
    } else {
        enableButton(nextButton);
    }

    if (pageCount === currentPage) {
        showButton();
    } else {
        hiddenButton();
    }
};

const handleActivePageNumber = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
        button.classList.remove("active");
        const pageIndex = Number(button.getAttribute("page-index"));
        if (pageIndex == currentPage) {
            button.classList.add("active");
        }
    });
};

const appendPageNumber = (index) => {
    const pageNumber = document.createElement("button");
    pageNumber.className = "pagination-number";
    pageNumber.innerHTML = index;
    pageNumber.setAttribute("page-index", index);
    pageNumber.setAttribute("aria-label", "Page " + index);

    paginationNumbers.appendChild(pageNumber);
};

const getPaginationNumbers = () => {
    for (let i = 1; i <= pageCount; i++) {
        appendPageNumber(i);
    }
};

const setCurrentPage = (pageNum) => {
    currentPage = pageNum;

    handleActivePageNumber();
    handlePageButtonsStatus();

    const prevRange = (pageNum - 1) * paginationLimit;
    const currRange = pageNum * paginationLimit;

    listItems.forEach((item, index) => {
        item.classList.add("hidden");
        if (index >= prevRange && index < currRange) {
            item.classList.remove("hidden");
        }
    });
};

window.addEventListener("load", () => {
    getPaginationNumbers();
    setCurrentPage(1);

    prevButton.addEventListener("click", () => {
        setCurrentPage(currentPage - 1);
    });

    nextButton.addEventListener("click", () => {
        setCurrentPage(currentPage + 1);
    });

    document.querySelectorAll(".pagination-number").forEach((button) => {
        const pageIndex = Number(button.getAttribute("page-index"));

        if (pageIndex) {
            button.addEventListener("click", () => {
                setCurrentPage(pageIndex);
            });
        }
    });
});

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