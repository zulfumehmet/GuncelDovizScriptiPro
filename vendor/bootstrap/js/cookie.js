window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#646478", // şerit arkaplan rengi
      "text": "#ffffff" // şerit üzerindeki yazı rengi
    },
    "button": {
      "background": "#8ec760", // buton arkaplan rengi - "transparent" kullanıp border açabilirsiniz.
	  //"border": "#14a7d0", arkaplan rengini transparent yapıp çerçeve kullanabilirsini
      "text": "#ffffff" // buton yazı rengi
    }
  },
  "theme": "classic", // kullanabileceğiniz temalar block, edgeless, classic
  // "type": "opt-out", gizle uyarısını aktif etmek için
  // "position": "top", aktif ederseniz uyarı üst kısımda görünür
  // "position": "top", "static": true, aktif ederseniz uyarı üst kısımda sabit olarak görünür
  // "position": "bottom-left", aktif ederseniz uyarı solda görünür
  //"position": "bottom-right", aktif ederseniz uyarı sağda görünür
  
  "content": {
    "message": "Sitemizden en iyi şekilde faydalanabilmeniz için çerezler kullanılmaktadır. Bu siteye giriş yaparak çerez kullanımını kabul etmiş sayılıyorsunuz.",
    "dismiss": "Tamam",
    "link": "Daha fazla bilgi",
    "href": "https://www.piyasa.tk"
  }
})});