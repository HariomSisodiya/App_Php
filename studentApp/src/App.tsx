import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'
// import './App.css'
import Dashboard from './Component/Dashboard/Dashboard'
import Courses from './Component/Courses';
import Home from './Component/Dashboard/Home';
import CourseList from './Component/Dashboard/CourseList';

function App() {

  return (
    <>
      <Router basename='/react'>
        <Routes>
          <Route path='/' element={<Dashboard />} >
            <Route index element={<Home/>} />
            <Route path='courses' element={<Courses/>} />
            <Route path='courseList' element={<CourseList/>} />
          </Route>
        </Routes>
      </Router>
    </>
  )
}

export default App;
