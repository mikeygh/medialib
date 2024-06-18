function del (id) { if (confirm("Delete media?")) {
    document.getElementById("ninID").value = id;
    document.getElementById("ninForm").submit();
  }}