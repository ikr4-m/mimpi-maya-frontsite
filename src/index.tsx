import {
  LocationProvider,
  Router,
  Route,
  hydrate,
  prerender as ssr
} from 'preact-iso';
import NotFoundPage from './pages/_404';
import HomePage from './pages/index';
import Navbar from './components/navbar';
import './index.css';

const App = () => {
  return (
    <main className='min-h-screen w-full'>
      <LocationProvider>
        <Navbar />
        {/*
          TODO: Delete this and replace as a standalone container if
          theres something wrong when we animate this shit.
        */}
        <div className='container mx-auto'>
          <Router>
            <Route path='/' component={HomePage} />
            <Route path='*' component={NotFoundPage} />
          </Router>
        </div>
      </LocationProvider>
    </main>
  )
}

if (typeof window !== 'undefined') {
	hydrate(<App />, document.getElementById('app'));
}

export async function prerender(data: any) {
	return await ssr(<App {...data} />);
}
