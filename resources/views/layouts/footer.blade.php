<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2025 &copy; Arena Sport</p>
        </div>
        <div class="float-end">
        </div>
    </div>
</footer>
</div>
{{-- batas main-content --}}
</div>

</div>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('templates/assets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('templates/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('templates/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('templates/assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('templates/assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('templates/assets/js/main.js') }}"></script>
<script src="{{ asset('templates/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('templates/assets/vendors/quill/quill.min.js') }}"></script>
<script src="{{ asset('templates/assets/js/pages/form-editor.js') }}"></script>
{{-- <script src="{{ asset('templates/assets/vendors/ckeditor/ckeditor.js') }}"></script> --}}

<script src="{{ asset('templates/assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('templates/assets/vendors/summernote/summernote-lite.min.js') }}"></script>
<!-- Tambahkan jQuery dan Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('#fasilitas').select2({
            placeholder: "Pilih fasilitas",
            allowClear: true
        });
    });
</script>

{{-- <textarea ></textarea> --}}
<script>
    $('#note').summernote({
        tabsize: 2,
        height: 120,
    })
    $("#hint").summernote({
        height: 100,
        toolbar: false,
        placeholder: 'type with apple, orange, watermelon and lemon',
        hint: {
            words: ['apple', 'orange', 'watermelon', 'lemon'],
            match: /\b(\w{1,})$/,
            search: function(keyword, callback) {
                callback($.grep(this.words, function(item) {
                    return item.indexOf(keyword) === 0;
                }));
            }
        }
    });
</script>

{{-- //texarea --}}
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
{{-- review gambar --}}
<script>
    document.getElementById("imageInput").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById("preview");
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });
</script>

{{-- review gambar banyak --}}
<script>
    function previewImages() {
        var preview = document.getElementById('imagePreview');
        preview.innerHTML = "";
        var files = document.getElementById('gambarInput').files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.width = 100;
                img.style.margin = "5px";
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
</script>

<script>
    tinymce.init({
      selector: '#myEditor',
      menubar: false,
      toolbar: 'bold italic underline | link | bullist numlist | fontselect',
      plugins: 'link lists',
      branding: false
    });
  </script>

</body>

</html>
