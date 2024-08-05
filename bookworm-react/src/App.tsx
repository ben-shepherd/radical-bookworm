import { SnackbarProvider } from "notistack";
import { Provider } from "react-redux";
import { BrowserRouter } from "react-router-dom";
import Header from './components/theme/Header';
import Sidebar from './components/theme/Sidebar';
import { store } from './redux/store';
import Routes from './routes';
import './styles/styles.scss';

function App() {

  return (
    <Provider store={store}>
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
    </Provider>
  );
}

export default App;
