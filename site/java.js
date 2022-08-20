window.onload = ()=>{
	mostrar(['#formB','#bnt1Aba','#formA','#bntAba'], 2);
}
function mostrar(ocu, chave){
	for (var i=0; i<ocu.length; i++){
		if (i<chave){
			ocultar(ocu[i], 0);	
		}else{
			ocultar(ocu[i], 1);
		};	
	};
};
function ocultar(obj, es) {
	let div = document.querySelector(obj);
	if(es==1){
		div.style.display = 'flex';
	}else{
		div.style.display = 'none';
	};
};

function drop(bt, id, fun){
	var res = 0;
	let drop = document.querySelector(id);
	if(fun==0){
		res=1;
		drop.style.display = 'flex';
	}else{
		drop.style.display = 'none';
	}	
	let onclick = "drop(this,'"+id+"',"+res+")";
	bt.setAttribute('onclick', onclick);
}