class Mapping {
	constructor(){
		console.clear();
	}
	testMapping(url){
	    let checkbox = Object.values(document.querySelectorAll("input[type='checkbox']"));
	    checkbox.forEach((x)=>{
	        x.addEventListener('click', ()=>{
	            if(x.checked==true){
	                x.closest('.box').classList.add('color');
	            }else{
	                x.closest('.box').classList.remove('color');
	            }
	        });
	    });

	    let alltest = Object.values(document.querySelectorAll('.alltest'));
	    alltest.forEach((x)=>{
	        x.addEventListener('change', ()=>{
	            http(url, {test_id : x.value})
	            .then(response=>{
	                var test_ids = JSON.parse(response).map(x=>+x);
	                checkbox.forEach((x)=>{
	                    if(test_ids.indexOf(+x.value)>-1){
	                        x.checked = true;
	                        x.closest('.box').classList.add('color');
	                    }else{
	                        x.checked = false;
	                        x.closest('.box').classList.remove('color');
	                    }
	                });
	            });
	        });
	    });

	    
	    // HTTP Request With Asynchronous
	    async function http (url, data={}){
	        var formdata = new FormData();
	        for(const i in data){
	            formdata.append(i, data[i]);
	        }
	        var response = "";
	        var xml = new XMLHttpRequest();
	        xml.onreadystatechange = function(){
	            if(this.readyState == 4 && this.status == 200){
	                response = this.responseText;
	            }
	        }
	        xml.open("POST", url, false);
	        xml.send(formdata);
	        return response;
	    }
	}

	groupMapping(url){
		let checkbox = Object.values(document.querySelectorAll("input[type='checkbox']"));
	    checkbox.forEach((x)=>{
	        x.addEventListener('click', ()=>{
	            if(x.checked==true){
	                x.closest('.box').classList.add('color');

	            }else{
	                x.closest('.box').classList.remove('color');
	            }
	        });
	    });


	    let allgroup = Object.values(document.querySelectorAll('.allgroup'));
	    allgroup.forEach((x)=>{
	        x.addEventListener('change', ()=>{
	            http(url, {group_id : x.value})
	            .then(response=>{
	                var test_ids = JSON.parse(response).map(x=>+x);
	                checkbox.forEach((x)=>{
	                    if(test_ids.indexOf(+x.value)>-1){
	                        x.checked = true;
	                        x.closest('.box').classList.add('color');
	                    }else{
	                        x.checked = false;
	                        x.closest('.box').classList.remove('color');
	                    }
	                })
	            });
	        });
	    });

	    
	    // HTTP Request With Asynchronous
	    async function http (url, data={}){
	        var formdata = new FormData();
	        for(const i in data){
	            formdata.append(i, data[i]);
	        }
	        var response = "";
	        var xml = new XMLHttpRequest();
	        xml.onreadystatechange = function(){
	            if(this.readyState == 4 && this.status == 200){
	                response = this.responseText;
	            }
	        }
	        xml.open("POST", url, false);
	        xml.send(formdata);
	        return response;
	    }
	}
	search(s, a, c, f){
		let search = document.querySelector(s);
		let content = (Object.values(search.closest(a).querySelectorAll(c)));
		if(search && content){
			search.addEventListener('input', ()=>{
				content.forEach((sigle)=>{
					if((sigle.innerText.toLocaleLowerCase()).indexOf(search.value.toLocaleLowerCase()) > -1){
						sigle.closest(f).classList.remove('d-none');
					}else{
						sigle.closest(f).classList.add('d-none');
					}
				});
			});
		}
	}
}