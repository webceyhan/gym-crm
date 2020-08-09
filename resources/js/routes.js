// import pages
import HomePage from "./pages/Home";
import MembersPage from "./pages/Members";
import PlansPage from "./pages/Plans";
import PlanPage from "./pages/Plan";

export default [
    { path: "/home", name: "home", component: HomePage },
    { path: "/members", name: "members", component: MembersPage },
    { path: "/plans", name: "plans", component: PlansPage },
    { path: "/plans/:id", name: "plan", component: PlanPage }
];
