import { SnackbarProvider } from "notistack";
import { BrowserRouter } from "react-router-dom";
import Header from './components/theme/Header';
import Sidebar from './components/theme/Sidebar';
import Routes from './routes';
import './styles/styles.scss';

function App() {

  return (
    <BrowserRouter>
      <SnackbarProvider />
      
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
