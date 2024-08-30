import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'
// import './App.css'
import Dashboard from './Component/Dashboard/Dashboard'
import Courses from './Component/Courses';

function App() {

  return (
    <>
      <Router basename='/react'>
        <Routes>
          <Route path='/' element={<Dashboard />} >
            <Route path='/courses' element={<Courses/>} />
          </Route>
        </Routes>
      </Router>
    </>
  )
}

export default App;
