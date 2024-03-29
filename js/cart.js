document.addEventListener("alpine:init", () => {
    Alpine.data("products", () => ({
      items: [
        { id: [], name: [], img: [], price: [] },
      ],
    }));
  
    Alpine.store('cart', {
      items: [],
      total: 0,
      quantity: 0,
      add(newItem) {
        // cek apakah ada barang yang sama di keranjang ?
        const cartItem = this.items.find((item) => item.id === newItem.id);
  
        //jika blum ada
        if (!cartItem) {
          this.items.push({...newItem, quantity: 1, total: newItem.price});
          this.quantity++;
          this.total += newItem.price;
        } else {
          // jika barang sudah ada,cek apakah barang beda atw sama yanng ada di keranjang ?
          this.items = this.items.map((item) => {
            // jika barang beda
            if (item.id !== newItem.id) {
              return item;
            } else {
              // jika barang sudah ada, tambah quantity dan total
              item.quantity++;
              item.total = item.price * item.quantity;
              this.quantity++;
              this.total += item.price;
              return item;
            }
          });
        }
  
      },
  
      remove(id) {
        // ambil item yang mau di remove berdasarkan id
        const cartItem = this.items.find((item) => item.id === id);
  
        // jika item lebih dari 1 
        if (cartItem.quantity > 1 ){
          // telusuri 1 1
          this.items = this.items.map((item) => {
            // jika bukan barang yang di klik
            if(item.id !== id) {
                return item;
            } else {
              item.quantity--;
              item.total = item.price * item.quantity;
              this.quantity--;
              this.total -= item.price;
              return item;
            }
          })
        } else if (cartItem.quantity === 1) {
          // jika barangnya sisa 1
          this.items = this.items.filter((item) => item.id !== id);
          this.quantity--;
          this.total -= cartItem.price;
        }
  
      },
    });
  });
  
  // kririm data ketika checout diklik
  document.addEventListener('DOMContentLoaded', function() {
    const checkoutButton = document.querySelector('.checkout-button');
    const form = document.querySelector('form');

    // kirim data
    checkoutButton.addEventListener('click', async function(e){
        e.preventDefault();
        const formData = new FormData(form);
        const data = new URLSearchParams(formData);
        const objData = Object.fromEntries(data);
        const message = formatMessage(objData);
        window.open('http://wa.me/6285767389484?text=' + encodeURIComponent(message));
      
    });
});

  
  // format pesan whatsAPP
  const formatMessage = (obj) => {
    return `Data Customer: 
    Nama : ${obj.name}
    Email : ${obj.email}
    No HP : ${obj.phone}
  Data pesanan:
  ${JSON.parse(obj.items).map((item) => `${item.name} (${item.quantity} x ${rupiah(item.total)}) \n`)}
  TOTAL: ${rupiah(obj.total)}
  Terima Kasih.`;
  };
  
  // konversi maata uang ke rupiah
  const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      minimumFractionDigits: 0,
    }).format(number);
  };
  