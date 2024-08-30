import { Outlet } from "react-router-dom";
import SideBar from "../Sidebar";

export default function Dashboard() {
    return (
        <>
            <div className="dashboard">
                <div className="side-bar">
                    <SideBar/>
                </div>
                <div className="Dash-board" >
                    <Outlet/>
                </div>
                {/* <div className="">

                <SideBar />
                </div>

                <div  className="border">
                    <Outlet/>
                </div> */}

            </div>
        </>
    )
}
