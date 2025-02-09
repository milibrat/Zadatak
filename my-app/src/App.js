import React, { useState } from 'react';

const WordEntry = () => {
  const [word, setWord] = useState('');
  const [score, setScore] = useState(null);

  const handleSubmit = async () => {
    try {
      
      const response = await fetch(`http://localhost:8000/entry/${word}`);
      const data = await response.json();
      setScore(data.score);
    } catch (error) {
      console.error('Error fetching entry:', error);
    }
  };

  return (
    <div>
      <input
        type="text"
        value={word}
        onChange={(e) => setWord(e.target.value)}
        placeholder="Enter a word"
      />
      <button onClick={handleSubmit}>Get Entry</button>
      {score !== null && <p>Entry: {score}</p>}
    </div>
  );
};

export default WordEntry;
