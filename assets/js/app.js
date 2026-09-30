function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('show');
}
document.addEventListener('click', function(e){
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth <= 900 && sidebar.classList.contains('show') &&
        !sidebar.contains(e.target) && !e.target.closest('.hamburger')) {
        sidebar.classList.remove('show');
    }
});
function setTradeType(type){
    document.querySelectorAll('.trade-tab').forEach(x => x.classList.remove('selected'));
    const tab = document.getElementById('tab-' + type);
    if(tab) tab.classList.add('selected');
    const input = document.getElementById('trade-type');
    if(input) input.value = type;
    const btn = document.getElementById('submit-trade');
    if(btn) {
        btn.textContent = type === 'BUY' ? 'Place Buy Order' : 'Place Sell Order';
        btn.classList.toggle('sell-button', type === 'SELL');
    }
}
