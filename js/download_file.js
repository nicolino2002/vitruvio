
  function download(filename,town_id){
    var town=document.getElementById('town').value;
    fetch('../uploads/'+town+'-'+town_id+'-'+filename)
      .then(resp => resp.blob())
      .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        // the filename you want
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        //alert('your file has downloaded!'); // or you know, something with better UX...
      })
      .catch(() => alert('oh no!'));
  }

  
