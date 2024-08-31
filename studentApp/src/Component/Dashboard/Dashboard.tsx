import { useEffect } from "react";
import { Outlet, useLocation } from "react-router-dom";
import SideBar from "../Sidebar";

export default function Dashboard() {
    const { search } = useLocation();
    const query = new URLSearchParams(search);
    const studentId = query.get('student_id');
    const authToken = query.get('auth_token');

    useEffect(() => {
        if (authToken && studentId) {
            sessionStorage.setItem('auth_token', authToken);
            sessionStorage.setItem('studentId', studentId);
        }
    }, []); // Only re-run effect if authToken or studentId changes

    return (
        <div className="container-fluid d-flex justify-content-between">
            <SideBar />
            <Outlet />
        </div>
    );
}
