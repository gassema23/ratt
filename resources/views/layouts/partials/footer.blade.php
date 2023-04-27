<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('calendar/index.global.js') }}"></script>
@stack('scripts')
<script defer>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imgPreview', () => ({
            imgsrc: null,
            previewFile() {
                let file = this.$refs.myFile.files[0];
                console.log(file)
                if (!file || file.type.indexOf('image/') === -1) return;
                this.imgsrc = null;
                let reader = new FileReader();
                reader.onload = e => {
                    this.imgsrc = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }))
    });
</script>
</body>

</html>
