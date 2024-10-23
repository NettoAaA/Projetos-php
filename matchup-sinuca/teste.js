const generateMatches = (numMatches) => {
    const matches = [];
  
    for (let i = 0; i < numMatches; i++) {
      let player_one_id, player_two_id;
  
      do {
        player_one_id = Math.floor(Math.random() * 6) + 1; // IDs entre 1 e 6
        player_two_id = Math.floor(Math.random() * 6) + 1; // IDs entre 1 e 6
      } while (player_one_id === player_two_id); // Garante que os IDs sejam diferentes
  
      const result = Math.max(player_one_id, player_two_id); // lógica para o resultado
  
      matches.push({
        player_one_id,
        player_two_id,
        player_one: { connect: { id: player_one_id } }, // Formato correto
        player_two: { connect: { id: player_two_id } }, // Formato correto
        result,
      });
    }
  
    return matches;
  };
  
  const singleMatch = generateMatches(1000);
  
  // Exemplo de uso:
  console.log(singleMatch);
  