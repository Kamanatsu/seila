//=========== ORDEM DO CODIGO ========//
// 1 - CLASSES                        //
// 2 - INTERAÇÃO COM O BANCO DE DADOS //
// 3 - 
//====================================//




class Cliente {
    constructor(id, nome, endereco, telefone) {
        this.id = id;
        this.nome = nome;
        this.endereco = endereco;
        this.telefone = telefone;
    }
}

class Pedido {
    constructor(id, dataPedido, status, precoTotal, cliente) {
        this.id = id;
        this.dataPedido = dataPedido;
        this.status = status;
        this.precoTotal = precoTotal;
        this.cliente = cliente; // FK_Cliente
        this.pizzas = []; // Lista de pizzas no pedido
    }

    adicionarPizza(pizza) {
        this.pizzas.push(pizza);
    }
}

class Pizza {
    constructor(id, tamanho, sabor, preco, status) {
        this.id = id;
        this.tamanho = tamanho;
        this.sabor = sabor;
        this.preco = preco;
        this.status = status;
    }
}

class Atendente {
    constructor(id, nome, funcao) {
        this.id = id;
        this.nome = nome;
        this.funcao = funcao;
    }
}