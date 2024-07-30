import './styles/styles.scss';
import React from 'react';
import { BrowserRouter, BrowserRouter as Router } from "react-router-dom";
import Sidebar from './components/theme/Sidebar';
import Routes from './routes';
import Header from './components/theme/Header';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Header />

        <main>
          <Sidebar />

          <div className="AppContent flex">
            <Routes />
          </div>

        </main>
      </div>
      </BrowserRouter>
  );
}

export default App;
