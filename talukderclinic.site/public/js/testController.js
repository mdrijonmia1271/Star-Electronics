class Test {
    constructor()
    {
        Test.patientInformation();
        Test.testAddBtn();
        Test.addParameter();
        Test.testEvent();
        Test.parameterEvent();
    }
    static total_test 	= 1;
    static clean		= false;

    static ObToArr(x){
    	return Array.isArray(x) ? x : Object.values(x);
    }
	//Get Patient Information
    static patientInformation()
    {
        let patient 		= document.querySelector('#patient');
        let field_loader 	= document.querySelector('#field_loader');
        let patient_name 	= document.querySelector("input[name='patient_name']");
        let patient_pid 	= document.querySelector("input[name='patient_pid']");
        let patient_id 		= document.querySelector("input[name='patient_id']");
        
        patient.addEventListener('change', ()=>{
            
            patient_name.value = '';
            patient_pid.value = '';
            patient_id.value = '';
            field_loader.style.display = 'block';
            
            fetch(window.location.origin+'/reports/ajax/patientInfo/'+patient.value)
            .then(myJson=>myJson.json())
            .then(data=>{
                patient_name.value = data.name;
                patient_pid.value = data.pid;
                patient_id.value = data.id;
                field_loader.style.display = 'none';
            })
        });
    }


    // Test Add Botton
    static testAddBtn()
    {
    	let test_group		= document.querySelector('.test-group');
    	let test_add_btns 	= this.ObToArr(document.querySelectorAll('.test-add-btn'));

	    	test_add_btns.forEach((test_add_btn, test_add_btn_key)=>{
	    		test_add_btn.addEventListener('click',()=>{
	    			if(test_group){
	    				this.newTestContent(test_group);
	    				this.select2Hendle();
	    				this.closeTest();
	    				this.testEvent();
	    			}
	    		});
	    	});
    	
    }

    // Test Close Button
    static closeTest()
    {
    	let close_tests = this.ObToArr(document.querySelectorAll('.close-test'));
    	if(close_tests){
	    	close_tests.forEach((close_test)=>{
	    		close_test.addEventListener('click', (event)=>{
	    			if(close_test.closest('.all_test')){
	    				close_test.closest('.all_test').remove();
	    			}
	    		});
	    	});  
	    	this.total_test = this.total_test - 1;  		
    	}
    }

    // Test Event
    static testEvent()
    {
    	let test_fields = this.ObToArr(document.querySelectorAll('.test_field'));
    		test_fields.forEach((test_field)=>{
    			test_field.addEventListener('change', ()=>{
    				if(test_field.value)
    				{
    					let all_groups = this.ObToArr(test_field.closest('.all_test').querySelector('.all_procedure').children);
    					all_groups.forEach((all_groups, group_key)=>{
    						if(group_key != 0){
    							all_groups.remove();
    						}
    					})
	    				this.fatchParameter(test_field);
    				}
    				test_field.closest('.all_test').querySelector('.standard').value = '';
    			});
    			test_field.addEventListener('click', ()=>{
    				test_field.classList.add('dropup');
    			});
    		});
    }

    // Fetch parameter
    static fatchParameter(test_field)
    {
		let newOption = '';
    	fetch(window.location.origin+'/reports/ajax/parameterInfo/'+test_field.value)
        .then(myJson=>myJson.json())
        .then(data=>{
        	let parameters = this.ObToArr(data);
        	if(parameters){
        		parameters.forEach((parameter)=>{
        			newOption += `<option value="${parameter.id}">${parameter.parameter}</option>`;
        		});
	            this.newSelect(test_field, newOption);
        	}
        })
    }

    // New Option
    static newSelect(test_field, newOption){
    	if((test_field.closest('.all_test')).querySelectorAll('.input-group')[1])
        {
    	let old_name = test_field.closest('.all_test').querySelectorAll('.input-group')[1].querySelector("select").getAttribute('name');
    	
        	let newDiv = document.createElement('div');
        	newDiv.setAttribute('class', 'input-group-btn');
        	newDiv.innerHTML = `
				<select name="${ old_name }" class="selectpicker2 form-control parameter" data-show-subtext="true" data-live-search="true">
                    <option value="" selected disabled>&nbsp;parameter</option>
                    ${newOption}                 
                </select>
        	`;
        	(test_field.closest('.all_test')).querySelectorAll('.input-group ')[1].firstElementChild.remove();
        	(test_field.closest('.all_test')).querySelectorAll('.input-group ')[1].prepend(newDiv);
        }

        this.select2Hendle();
        this.parameterEvent()
    }

    // Add Parameter
    static addParameter(x=null)
    {
    	if(x != null){
    		let addBtn = document.querySelector('.add-parameter'+x);
		    	addBtn.addEventListener('click', (event)=>{
	    			let parent = addBtn.closest('.all_procedure');
	    			let name = parent.querySelector('.value').getAttribute('name').replace('value[','').replace('][]','');
	    			this.setParameter(parent, addBtn, name);
	    		});
    	}else{
	    	let addBtns = this.ObToArr(document.querySelectorAll('.add-parameter'));
		    	addBtns.forEach((addBtn)=>{
		    		addBtn.addEventListener('click', (event)=>{
		    			let parent = addBtn.closest('.all_procedure');
		    			let name = parent.querySelector('.value').getAttribute('name').replace('value[','').replace('][]','');
		    			this.setParameter(parent, addBtn, name);
		    		});
		    	});

    	}
    }

    // Set Parameter
    static setParameter(parent, addBtn, name)
    {
    	console.log(name);

    	let option = addBtn.closest('.input-group').querySelector('select').innerHTML;
    	let div = document.createElement('div');
    		div.setAttribute('class', 'form-group');
    	let content = `
            <label for="" class="col-md-3 control-label"></label>
            <div class="col-md-6 mb-1">
                <div class="input-group ">
                    <div class="input-group-btn" >
                        <select name="parameter[${name}][]" class="selectpicker2 form-control parameter" data-show-subtext="true" data-live-search="true" required>
                            <option value="" selected disabled>&nbsp;parameter</option>                       
                        </select>
                    </div>
                    
                    <div class="input-group-btn" >
                        <input type="text" name="standard[${name}][]" class="form-control standard" placeholder="Standard" readonly required>
                    </div>
                    
                    <div class="input-group-btn" >
                        <input type="text" name="value[${name}][]" class="form-control value" placeholder="Value" required>
                    </div>
                    
                    <span class="input-group-text">
                        <button class="btn btn-warning close-parameter" type="button"> <i class="fa fa-close" aria-hidden="true"></i> </button>
                    </span>
                </div>
            </div>
		`;
		div.innerHTML = content;
		div.querySelector('select').innerHTML = option;
		parent.append(div);	

		this.parameterEvent();
		this.select2Hendle();
		this.closeParameter();

		let bootstrap_selects = Object.values(document.querySelectorAll('.bootstrap-select'));
		bootstrap_selects.forEach((bootstrap_select)=>{
			if(bootstrap_select.classList.contains('open')){
				bootstrap_select.classList.add('dropup');
			}
		});

		
		return true;
    }

    // Close Parameter Field
    static closeParameter()
    {
    	let close_parameters = this.ObToArr(document.querySelectorAll('.close-parameter'));
    		close_parameters.forEach((close_parameter)=>{
    			close_parameter.addEventListener('click', ()=>{
    				close_parameter.closest('.form-group').remove();
    			});
    		});
    }

    static newTestContent(test_group){

    	let newDiv = document.createElement('div');
    	newDiv.setAttribute('class', 'all_test');

    	let main_test	= document.querySelector('#main_test');

        let content 	= `
            <div class="form-group">
                <label for="" class="col-md-2 control-label">Test ${ (test_group.childElementCount)+1 } </label>
                <div class="col-md-7" >
                    <div class="input-group">
                        <div class="input-group-btn" style="width: 100% !important;" >
                            <select name="test[test_${(test_group.childElementCount)+1}][]" class="selectpicker2 form-control test_field" data-show-subtext="true" data-live-search="true" required></select>
                        </div>
                        <span class="input-group-text">
                            <button class="btn btn-warning close-test" type="button""> <i class="fa fa-close" aria-hidden="true"></i> </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="procedure_group">
                <div class="all_procedure">
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label"></label>
                        <div class="col-md-6 mb-1">
                            <div class="input-group ">
                                <div class="input-group-btn" >
                                    <select name="parameter[test_${(test_group.childElementCount)+1}][]" class="selectpicker2 form-control parameter" data-show-subtext="true" data-live-search="true" required>
                                        <option value="" selected disabled>&nbsp;parameter</option>                      
                                    </select>
                                </div>
                                
                                <div class="input-group-btn" >
                                    <input type="text" name="standard[test_${(test_group.childElementCount)+1}][]" class="form-control standard" placeholder="Standard" readonly required>
                                </div>
                                
                                <div class="input-group-btn" >
                                    <input type="text" name="value[test_${(test_group.childElementCount)+1}][]" class="form-control value" placeholder="Value" required>
                                </div>
                                
                                <span class="input-group-text">
                                    <button class="btn btn-primary add-parameter${ test_group.childElementCount }" type="button"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        newDiv.innerHTML = content; 
        test_group.append(newDiv);

        let new_select_box = test_group.lastElementChild.firstElementChild.lastElementChild.firstElementChild.firstElementChild.firstElementChild;
        new_select_box.innerHTML = (main_test.innerHTML);

        this.addParameter(test_group.childElementCount-1);
        this.parameterEvent();
        this.total_test += 1;
        return true;
    }
    // Fatech Parameters data
    static parameterEvent(){
    	let parameters = this.ObToArr(document.querySelectorAll('.parameter'));
	    	parameters.forEach((parameter)=>{
	    		parameter.addEventListener('change', ()=>{
	    			this.fatchParameterData(parameter.value, parameter.closest('.input-group'));
	    		});
	    		parameter.addEventListener('click', ()=>{
					parameter.classList.add('dropup');
	    		});
	    	});
    }

    static fatchParameterData(id, parent){
    	if(id){
    		console.log(parent);
	    	fetch(window.location.origin+'/reports/ajax/parameterData/'+id)
	        .then(myJson=>myJson.json())
	        .then(data=>{
	        	let parameters = this.ObToArr(data);
	        	if(parameters){
	        		parent.querySelector('.standard').value = parameters[0].referral_value;
	        		console.log(parameters[0]);
	        	}else{
	        		parent.querySelector('.standard').value = '';
	        	}
	        });
    	}
    }

    static select2Hendle()
    {
    	$('.selectpicker2').selectpicker({
    		dropdownAuto: false,
    		dropupAuto: false,
    	});
    }
    
}

window.addEventListener('load', ()=>{
	new Test();	
	window.addEventListener('scroll', ()=>{
		let bootstrap_selects = Object.values(document.querySelectorAll('.bootstrap-select'));
		bootstrap_selects.forEach((bootstrap_select)=>{
			if(bootstrap_select.classList.contains('open')){
				bootstrap_select.classList.add('dropup');
			}
		});
	});
});