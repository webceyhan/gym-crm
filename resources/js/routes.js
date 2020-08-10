// import pages
import HomePage from "./pages/Home";
import MembersPage from "./pages/Members";
import MemberPage from "./pages/Member";
import PlansPage from "./pages/Plans";
import PlanPage from "./pages/Plan";

export default [
    { path: "/", redirect: "/home" },
    { path: "/home", name: "home", component: HomePage },
    { path: "/members", name: "members", component: MembersPage },
    { path: "/members/:id", name: "members", component: MemberPage },
    { path: "/plans", name: "plans", component: PlansPage },
    { path: "/plans/:id", name: "plan", component: PlanPage }
];
