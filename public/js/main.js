// Função para buscar e atualizar estatísticas
async function carregarEstatisticas() {
    try {
        const response = await fetch('/estatisticas');
        const data = await response.json();

        // Grêmio
        document.getElementById('total-jogos-gremio').textContent = data.total_jogos;
        document.getElementById('vitorias-gremio').textContent = data.vitorias_gremio;
        document.getElementById('derrotas-gremio').textContent = data.total_jogos - data.vitorias_gremio - data.empates;
        document.getElementById('empates-gremio').textContent = data.empates;
        document.getElementById('gols-gremio').textContent = data.gols_gremio;

        // Inter
        document.getElementById('total-jogos-inter').textContent = data.total_jogos;
        document.getElementById('vitorias-inter').textContent = data.vitorias_inter;
        document.getElementById('derrotas-inter').textContent = data.total_jogos - data.vitorias_inter - data.empates;
        document.getElementById('empates-inter').textContent = data.empates;
        document.getElementById('gols-inter').textContent = data.gols_inter;

    } catch (error) {
        console.error("Erro ao carregar estatísticas:", error);
    }
}


// Executa ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    carregarEstatisticas();

    const form = document.querySelector('.form-placar');
    if (form) {
        form.addEventListener('submit', enviarPlacar);
    }
});
