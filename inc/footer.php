
        </main> <!-- /container -->
            
      <footer class="footer-custom mt-2">
  <div class="footer-icons">
    <a href="https://www.instagram.com/personalchef.karolmarques" target="_blank" class="footer-link">
      <i class="fa-brands fa-instagram"></i>
    </a>
    <a href="https://www.tiktok.com/@chefkarolmarques" target="_blank" class="footer-link">
      <i class="fa-brands fa-tiktok"></i>
    </a>
    <a href="https://wa.me/5515998114782 " target="_blank" class="footer-link">
      <i class="fa-brands fa-whatsapp"></i>
    </a>
  </div>
    <?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); ?>
  <p class="footer-text">© &copy;2025 a <?php echo $data->format("Y"); ?> - Todos os direitos reservados á Kaiky, Julia e Helena</p>
</footer>

            
        
        <script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/main.js"></script>
      <script>
  // Auto-atribui data-label a cada <td> usando os textos do <th>
  (function() {
    try {
      const tables = document.querySelectorAll('.table');
      tables.forEach(table => {
        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
        if (headers.length === 0) return;
        table.querySelectorAll('tbody tr').forEach(row => {
          const cells = Array.from(row.querySelectorAll('td'));
          cells.forEach((td, i) => {
            if (!td.hasAttribute('data-label')) {
              const label = headers[i] || 'Campo';
              td.setAttribute('data-label', label);
            }
          });
        });
      });
    } catch (e) {
      console.warn('Auto data-label script falhou:', e);
    }
  })();
</script>


    </body>
</html>