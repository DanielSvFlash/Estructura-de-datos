class Node{
	data=null;
	next=null;
    constructor(data, next = null){
        this.data = data,
        this.next = next
    }
}


class LinkedList {

	head=null;
    size=0;

    constructor(data) {
        this.head=null;
    }

    add(data) {

        // create a new node
        const newNode = new Node(data);
                
        //special case: no items in the list yet
        if (this.head == null) {

            // just set the head to the new node
            this.head = newNode;
        } else {

            // start out by looking at the first node
            var current = this.head;

            // follow `next` links until you reach the end
            while (current.next != null || current.next !=undefined) {
                current = current.next;
            }
           
            // assign the node into the `next` pointer
            current.next = newNode;            
        }
        this.size++;
    }

    insertAt(element, index) 
    { 
        if (index > 0 && index > this.size) 
        {

            return false;
        }else if(element==="")
        {
            
        }
        else { 
            // creates a new node 
            var node = new Node(element); 
            var curr, prev; 
      
            curr = this.head; 
      
            // add the element to the 
            // first index 
            if (index == 0) { 
                node.next = this.head; 
                this.head = node; 
            } else { 
                curr = this.head; 
                var it = 0; 
      
                // iterate over the list to find 
                // the position to insert 
                while (it < index) { 
                    it++; 
                    prev = curr; 
                    curr = curr.next; 
                } 
      
                // adding an element 
                node.next = curr; 
                prev.next = node; 
            } 
            this.size++; 
        } 
    } 

    get(index) {
    
        // ensure `index` is a positive value
        if (index > -1) {

            // the pointer to use for traversal
            var current = this.head;

            // used to keep track of where in the list you are
            var i = 0;

            // traverse the list until you reach either the end or the index
            while ((current !== null) && (i < index)) {
                current = current.next;
                i++;          
            }
        
            // return the data if `current` isn't null
            return current !== null ? current.data : undefined;
        } else {
            return undefined;
        }
    }

    get_last()
    {
        var current = this.head;
        var i=0;

        while (current.next!=null)
        {
            current = current.next;
            i++;
        }
        // return the data if `current` isn't null
        return current !== null ? current.data : undefined;

    }
    remove(index) {
    
        // special cases: empty list or invalid `index`
        if ((this.head === null) || (index < 0)) {
            throw new RangeError(`Index ${index} does not exist in the list.`);
        }
 
        // special case: removing the first node
        if (index === 0) {

            // temporary store the data from the node
            const data = this.head.data;

            // just replace the head with the next node in the list
            this.head = this.head.next;

            // return the data at the previous head of the list
            this.size--;
            return data;
        }

        // pointer use to traverse the list
        var current = this.head;

        // keeps track of the node before current in the loop
        var previous = null;

        // used to track how deep into the list you are
        var i = 0;

        // same loops as in `get()`
        while ((current !== null) && (i < index)) {

            // save the value of current
            previous = current;

            // traverse to the next node
            current = current.next;

            // increment the count
            i++;
        }

        // if node was found, remove it
        if (current !== null) {

            // skip over the node to remove
            previous.next = current.next;

            // return the value that was just removed from the list
            this.size--;
            return current.data;
        }

        // if node wasn't found, throw an error
        throw new RangeError(`Index ${index} does not exist in the list.`);
    }

    *values(){
        
        var current = this.head;

        while (current !== null) {
            yield current.data;
            current = current.next;
        }
    }

    [Symbol.iterator]() {
        return this.values();
    } 



}



var lista_paradas = new LinkedList();
class arraylistparadas
{
	array=[];
	array_list=[];

	constructor()
	{

	}

	set_array(arreglo)
	{
		this.array=arreglo;
	}

	get_array()
	{
		return this.array;
	}

	//Este es el metodo en el cual voy a establecer las lineas como listas ligadas en un arreglo de listas
	set_array_list()
	{
		//contador
		var contador=0;
		//verifico que haya valores en el arreglo
		if(this.array.length>0)
		{
			var supercontador= 1;
			while(supercontador<=8)
			{
				var temp =[];
                contador=0;
				//Ciclo para recorrer todo el arreglo donde previamente guardamos el arreglo con todas las estaciones
				while(contador<this.array.length)
				{
                    //alert(this.array[contador].idlinea+" == "+supercontador);
					//Si el idlinea es de igual al supercontador que va del 0 al 7
					if(parseInt(this.array[contador].idlinea)==parseInt(supercontador))
					{  
						//Agregamos el valor a una cola temporal
						temp.unshift(this.array[contador]);
					}
					contador++;
				}
				//ordenamos el arreglo temporal
				temp = insertionSort(temp.slice());
				//restauramos valores
				contador=0;
				//creamo las linked list
				var lista_paradas = new LinkedList();
				//Ciclo para meter el arreglo ordenado en la lista ligada
				while(contador<temp.length)
				{
					lista_paradas.add(temp[contador]);
					contador++;
				}
				supercontador++;
				//metemos la linked list en el arreglo
				this.array_list.unshift(lista_paradas);
			}
		}else
		{
			alert("No hay valores en el arreglo");
		}
		this.array_list=this.array_list.reverse();
	}

	get_array_list()
	{
		return this.array_list;
	}

}




		function insertionSort(arr)
		{
		  for (let i = 1; i < arr.length; i++) {
		    let j = i - 1;
		    let tmp = arr[i];
		    while (j >= 0 && arr[j].idestacion > tmp.idestacion) {
		      arr[j + 1] = arr[j];
		      j--;
		    }
		    arr[j+1] = tmp;
		  }
		  return arr;
		}
